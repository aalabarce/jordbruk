const seasons = [
     {
    crop: 'Arroz',
    months: [10, 11]
  },
  {
    crop: 'Avena',
    months: [2, 3]
  },
  {
    crop: 'Girasol',
    months: [8, 9, 10]
  },
  {
    crop: 'Maíz',
    months: [9, 10, 11, 12]
  },
  {
    crop: 'Soja',
    months: [10, 11, 12]
  },
  {
    crop: 'Sorgo',
    months: [10, 11]
  },
  {
    crop: 'Trigo',
    months: [6, 7, 8]
  }
];

const crops = [
    'Arroz',
    'Avena',
    'Girasol',
    'Maíz',
    'Soja',
    'Sorgo',
    'Trigo'
];

function findLotsFromSameRegion(requestedLot) {
    // we only take into account the province to consider two lots are in the same region
    return lots.filter(lot => lot.province === requestedLot.province);
}

function filterCropsBySeason(crops, month) {
    return crops.filter(cropProfit => {
        const cropData = _.find(seasons, cropSeason => cropSeason.crop === cropProfit.crop);
        return cropData ? _.includes(cropData.months, month) : false;
    });
}

function dateSort(harvest) {
    return harvest.date.year * 10000 + harvest.date.month * 100 + harvest.date.day;
}

function applyRotation(cropProfits, lotId) {
    const plantedHarvests = harvests.filter(harvest => harvest.sowing.lot.id === lotId);
    const orderedPlantedHarvests = _.sortBy(plantedHarvests, dateSort).reverse();
    return cropProfits.filter(cropProfit => cropProfit.crop !== _.head(orderedPlantedHarvests).sowing.crop);
}

function getBestOption(lotId, shouldRotate, month) {
    lotId = parseInt(lotId, 10);
    month = parseInt(month, 10);

    $.ajax({
        type: 'GET',
        async: false,
        dataType: "JSON",
        url: Routing.generate('get_precios'),
        success: function (data) {
            window.prices = data;
        }
    });
    const prices = window.prices;

    $.ajax({
        type: 'GET',
        async: false,
        dataType: "JSON",
        url: Routing.generate('get_lotes'),
        success: function (data) {
            window.lots = data;
        }
    });
    const lots = window.lots;
    
    $.ajax({
        type: 'GET',
        async: false,
        dataType: "JSON",
        url: Routing.generate('get_siembras'),
        success: function (data) {
            window.sowings = _.map(data, (sowing) => {
                sowing.lot = lots.filter(lot => lot.id === sowing.lot)[0];
                return sowing;
            });
        }
    });    
    const sowings = window.sowings;
    
    $.ajax({
        type: 'GET',
        async: false,
        dataType: "JSON",
        url: Routing.generate('get_cosechas'),
        success: function (data) {
            window.harvests = _.map(data, (harvest) => {
                harvest.sowing = sowings.filter(sowing => sowing.id === harvest.sowing)[0];
                return harvest;
            });
        }
    });    
    const harvests = window.harvests;
    
    const requestedLot = _.find(lots, lot => lot.id === lotId);
    const similarLotIds = findLotsFromSameRegion(requestedLot).map(lot => lot.id);
    const similarHarvests = harvests.filter(harvest => _.includes(similarLotIds, harvest.sowing.lot.id));
    const harvestsPerCrop = _.groupBy(similarHarvests, harvest => harvest.sowing.crop);

    // use lodash map because harvestsPerCrop is an object
    const cropAverages = _.map(harvestsPerCrop, (harvests, crop) => {
        return {
            crop,
            average: _.meanBy(harvests, harvest => harvest.average)
        };
    });

    // transform average in profit
    const cropProfits = cropAverages.map(cropAverage => {
        const price = _.find(prices, price => price.crop === cropAverage.crop).price;
        return {
            crop: cropAverage.crop,
            profit: cropAverage.average * requestedLot.surface * price / 1000
        };
    });

    const orderedCropProfits = _.sortBy(cropProfits, ['profit']).reverse();

    if (_.isEmpty(orderedCropProfits)) {
        const result = _.maxBy(filterCropsBySeason(prices, month), cropPrice => cropPrice.price);
        if(result) {
            return {
                crop: result.crop,
                history: false,
                message: 'El resultado se basa en los precios de los granos en el mercado y en el mes de siembra especificado.'
            };
        } else {
            return {
                history: false,
                message: 'No hay resultado.'
            };            
        }
    } else {
        if (shouldRotate) {
            const result = _.head(applyRotation(filterCropsBySeason(orderedCropProfits, month), lotId));
            if (result) {
                return {
                    crop: result.crop,
                    profit: result.profit,
                    history: true,
                    message: 'El resultado se basa en el precio actual de los granos, los rindes registrados de la zona del lote y la superficie del campo.'
                };
            } else {
                const bestCrop = _.maxBy(filterCropsBySeason(prices, month), cropPrice => cropPrice.price);
                return {
                    crop: bestCrop ? bestCrop.crop : undefined,
                    history: false,
                    error: 'No hay datos para los cultivos que se pueden sembrar en el mes especificado o al aplicar el filtro de rotacion de cultivos no se encuentran cultivos.',
                    message: 'El resultado se basa en los precios de los granos en el mercado y en el mes de siembra especificado.'
                };
            }
        } else {
            const result = _.head(filterCropsBySeason(orderedCropProfits, month));
            if (result) {
                return {
                    crop: result.crop,
                    profit: result.profit,
                    history: true,
                    message: 'El resultado se basa en el precio actual de los granos, los rindes registrados de la zona del lote y la superficie del campo.'
                };
            } else {
                const bestCrop = _.maxBy(filterCropsBySeason(prices, month), cropPrice => cropPrice.price);
                return {
                    crop: bestCrop ? bestCrop.crop : undefined,
                    history: false,
                    error: 'No hay datos para los cultivos que se pueden sembrar en el mes especificado.',
                    message: 'El resultado se basa en los precios de los granos en el mercado y en el mes de siembra especificado.'
                };
            }
        }
    }
}
