const prices = [
    { crop: 'Arroz',    price: 153 },
    { crop: 'Avena',    price: 100 },
    { crop: 'Girasol',  price: 295 },
    { crop: 'Maiz',     price: 164 },
    { crop: 'Soja',     price: 272 },
    { crop: 'Sorgo',    price: 140 },
    { crop: 'Trigo',    price: 147 }
];

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
    crop: 'Maiz',
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
    'Maiz',
    'Soja',
    'Sorgo',
    'Trigo'
];

const lots = [
        {
            id: 1,
            number: 1,
            surface: 46,
            soil: 'Arcilloso',
            locality: 'Arrecifes',
            province: 'Buenos Aires'
        },
        {
            id: 2,
            number: 2,
            surface: 42,
            soil: 'Arcilloso',
            locality: 'Arrecifes',
            province: 'Buenos Aires'
        },
        {
            id: 3,
            number: 3,
            surface: 40,
            soil: 'Arcilloso',
            locality: 'Arrecifes',
            province: 'Buenos Aires'
        },
        {
            id: 4,
            number: 4,
            surface: 26,
            soil: 'Arcilloso',
            locality: 'Concepcion del Uruguay',
            province: 'Entre Rios'
        },
        {
            id: 5,
            number: 5,
            surface: 33,
            soil: 'Arcilloso',
            locality: 'Concepcion del Uruguay',
            province: 'Entre Rios'
        },
        {
            id: 6,
            number: 6,
            surface: 20,
            soil: 'Arcilloso',
            locality: 'Concepcion del Uruguay',
            province: 'Entre Rios'
        },
        {
         id: 7,
            number: 7,
            surface: 25,
            soil: 'Arcilloso',
            locality: 'Concepcion del Uruguay',
            province: 'Entre Rios'
        },
        {
          id: 8,
            number: 8,
            surface: 29,
            soil: 'Arcilloso',
            locality: 'San Lorenzo',
            province: 'Santa Fe'
        },
        {
         id: 9,
            number: 9,
            surface: 34,
            soil: 'Arcilloso',
            locality: 'San Lorenzo',
            province: 'Santa Fe'
        },
        {
            id: 10,
            number: 10,
            surface: 47,
            soil: 'Arcilloso',
            locality: 'San Lorenzo',
            province: 'Santa Fe'
        },
        {
            id: 11,
            number: 11,
            surface: 35,
            soil: 'Arcilloso',
            locality: 'Cordoba',
            province: 'Cordoba'
        }
    ];
    

const sowings =  [
  {
    id: 1,
    date: { day: 11, month: 10, year: 2014 },
    crop: crops[0],
    lot: lots[3],
    water: 800,
    plowed: true,
    fertilized: false,
    fumigated: true,
    cost: 98000
  },
  {
    id: 2,
    date: { day: 6, month: 11, year: 2014 },
    crop: crops[0],
    lot: lots[4],
    water: 620,
    plowed: true,
    fertilized: true,
    fumigated: false,
    cost: 105100
  },
  {
    id: 3,
    date: { day: 20, month: 10, year: 2014 },
    crop: crops[0],
    lot: lots[5],
    water: 700,
    plowed: true,
    fertilized: true,
    fumigated: true,
    cost: 90500
  },
  {
    id: 4,
    date: { day: 15, month: 10, year: 2014 },
    crop: crops[0],
    lot: lots[6],
    water: 730,
    plowed: true,
    fertilized: true,
    fumigated: false,
    cost: 78600
  },
  {
    id: 5,
    date: { day: 30, month: 10, year: 2014 },
    crop: crops[0],
    lot: lots[7],
    water: 890,
    plowed: true,
    fertilized: true,
    fumigated: true,
    cost: 119100
  },
  {
    id: 6,
    date: { day: 5, month: 11, year: 2014 },
    crop: crops[0],
    lot: lots[8],
    water: 910,
    plowed: true,
    fertilized: false,
    fumigated: true,
    cost: 110500
  },
  {
    id: 7,
    date: { day: 1, month: 11, year: 2015 },
    crop: crops[0],
    lot: lots[3],
    water: 690,
    plowed: true,
    fertilized: true,
    fumigated: false,
    cost: 120570
  },
  {
    id: 8,
    date: { day: 14, month: 10, year: 2015 },
    crop: crops[0],
    lot: lots[4],
    water: 710,
    plowed: true,
    fertilized: true,
    fumigated: true,
    cost: 98400
  },
  {
    id: 9,
    date: { day: 22, month: 10, year: 2015 },
    crop: crops[0],
    lot: lots[5],
    water: 670,
    plowed: true,
    fertilized: true,
    fumigated: false,
    cost: 90000
  },
  {
    id: 10,
    date: { day: 19, month: 10, year: 2014 },
    crop: crops[0],
    lot: lots[6],
    water: 650,
    plowed: true,
    fertilized: false,
    fumigated: true,
    cost: 92900
  },
  {
    id: 11,
    date: { day: 5, month: 9, year: 2014 },
    crop: crops[3],
    lot: lots[1],
    water: 820,
    plowed: false,
    fertilized: true,
    fumigated: true,
    cost: 107520
  },
  {
    id: 12,
    date: { day: 9, month: 11, year: 2014 },
    crop: crops[3],
    lot: lots[2],
    water: 800,
    plowed: true,
    fertilized: true,
    fumigated: false,
    cost: 110600
  },
  {
    id: 13,
    date: { day: 20, month: 11, year: 2014 },
    crop: crops[3],
    lot: lots[6],
    water: 750,
    plowed: false,
    fertilized: true,
    fumigated: true,
    cost: 106700
  },
  {
    id: 14,
    date: { day: 30, month: 9, year: 2014 },
    crop: crops[3],
    lot: lots[7],
    water: 670,
    plowed: true,
    fertilized: true,
    fumigated: false,
    cost: 98600
  },
  {
    id: 15,
    date: { day: 2, month: 11, year: 2014 },
    crop: crops[3],
    lot: lots[8],
    water: 690,
    plowed: false,
    fertilized: true,
    fumigated: true,
    cost: 99400
  },
  {
    id: 16,
    date: { day: 30, month: 10, year: 2014 },
    crop: crops[3],
    lot: lots[9],
    water: 700,
    plowed: true,
    fertilized: true,
    fumigated: true,
    cost: 100500
  },
  {
    id: 17,
    date: { day: 14, month: 10, year: 2015 },
    crop: crops[3],
    lot: lots[0],
    water: 800,
    plowed: false,
    fertilized: true,
    fumigated: true,
    cost: 102300
  },
  {
    id: 18,
    date: { day: 5, month: 11, year: 2015 },
    crop: crops[3],
    lot: lots[1],
    water: 780,
    plowed: false,
    fertilized: true,
    fumigated: false,
    cost: 90500
  },
  {
    id: 19,
    date: { day: 20, month: 9, year: 2015 },
    crop: crops[3],
    lot: lots[2],
    water: 800,
    plowed: false,
    fertilized: true,
    fumigated: true,
    cost: 94300
  },
  {
    id: 20,
    date: { day: 20, month: 11, year: 2015 },
    crop: crops[3],
    lot: lots[4],
    water: 750,
    plowed: false,
    fertilized: true,
    fumigated: false,
    cost: 104000
  },
  {
    id: 21,
    date: { day: 9, month: 10, year: 2014 },
    crop: crops[4],
    lot: lots[0],
    water: 500,
    plowed: false,
    fertilized: true,
    fumigated: true,
    cost: 85600
  },
  {
    id: 22,
    date: { day: 30, month: 10, year: 2014 },
    crop: crops[4],
    lot: lots[1],
    water: 590,
    plowed: true,
    fertilized: false,
    fumigated: true,
    cost: 82400
  },
  {
    id: 23,
    date: { day: 5, month: 11, year: 2014 },
    crop: crops[4],
    lot: lots[2],
    water: 270,
    plowed: false,
    fertilized: true,
    fumigated: true,
    cost: 63000
  },
  {
    id: 24,
    date: { day: 1, month: 12, year: 2014 },
    crop: crops[3],
    lot: lots[3],
    water: 370,
    plowed: true,
    fertilized: false,
    fumigated: true,
    cost: 77500
  },
  {
    id: 25,
    date: { day: 20, month: 11, year: 2014 },
    crop: crops[3],
    lot: lots[4],
    water: 480,
    plowed: false,
    fertilized: true,
    fumigated: true,
    cost: 72300
  },
  {
    id: 26,
    date: { day: 19, month: 11, year: 2014 },
    crop: crops[3],
    lot: lots[5],
    water: 550,
    plowed: false,
    fertilized: false,
    fumigated: true,
    cost: 45900
  },
  {
    id: 27,
    date: { day: 13, month: 10, year: 2014 },
    crop: crops[3],
    lot: lots[6],
    water: 600,
    plowed: false,
    fertilized: true,
    fumigated: true,
    cost: 71600
  },
  {
    id: 28,
    date: { day: 20, month: 10, year: 2015 },
    crop: crops[3],
    lot: lots[0],
    water: 720,
    plowed: false,
    fertilized: false,
    fumigated: true,
    cost: 82000
  },
  {
    id: 29,
    date: { day: 5, month: 10, year: 2015 },
    crop: crops[3],
    lot: lots[1],
    water: 430,
    plowed: false,
    fertilized: true,
    fumigated: true,
    cost: 86700
  },
  {
    id: 30,
    date: { day: 14, month: 11, year: 2015 },
    crop: crops[3],
    lot: lots[2],
    water: 600,
    plowed: false,
    fertilized: true,
    fumigated: true,
    cost: 90100
  },
  {
    id: 31,
    date: { day: 20, month: 6, year: 2014 },
    crop: crops[6],
    lot: lots[0],
    water: 340,
    plowed: false,
    fertilized: false,
    fumigated: false,
    cost: 45600
  },
  {
    id: 32,
    date: { day: 15, month: 7, year: 2014 },
    crop: crops[6],
    lot: lots[3],
    water: 500,
    plowed: true,
    fertilized: true,
    fumigated: false,
    cost: 38000
  },
  {
    id: 33,
    date: { day: 10, month: 7, year: 2014 },
    crop: crops[6],
    lot: lots[4],
    water: 520,
    plowed: false,
    fertilized: false,
    fumigated: false,
    cost: 53700
  },
  {
    id: 34,
    date: { day: 29, month: 7, year: 2014 },
    crop: crops[6],
    lot: lots[5],
    water: 600,
    plowed: true,
    fertilized: true,
    fumigated: true,
    cost: 48900
  },
  {
    id: 35,
    date: { day: 20, month: 7, year: 2014 },
    crop: crops[6],
    lot: lots[6],
    water: 570,
    plowed: true,
    fertilized: false,
    fumigated: false,
    cost: 45300
  },
  {
    id: 36,
    date: { day: 1, month: 8, year: 2014 },
    crop: crops[6],
    lot: lots[7],
    water: 510,
    plowed: false,
    fertilized: false,
    fumigated: false,
    cost: 67300
  },
  {
    id: 37,
    date: { day: 23, month: 7, year: 2014 },
    crop: crops[6],
    lot: lots[8],
    water: 430,
    plowed: true,
    fertilized: false,
    fumigated: false,
    cost: 58700
  },
  {
    id: 38,
    date: { day: 25, month: 6, year: 2015 },
    crop: crops[6],
    lot: lots[5],
    water: 400,
    plowed: true,
    fertilized: false,
    fumigated: false,
    cost: 32800
  },
  {
    id: 39,
    date: { day: 20, month: 6, year: 2015 },
    crop: crops[6],
    lot: lots[7],
    water: 420,
    plowed: true,
    fertilized: true,
    fumigated: true,
    cost: 46000
  },
  {
    id: 40,
    date: { day: 10, month: 7, year: 2015 },
    crop: crops[6],
    lot: lots[9],
    water: 600,
    plowed: false,
    fertilized: false,
    fumigated: true,
    cost: 39500
  }
];


const harvests = [
  {
    id: 1,
    date: { day: 20, month: 3, year: 2015 },
    sowing: sowings[0],
    average: 9400,
    profit: 9400 * prices[0].price
  },
  {
    id: 2,
    date: { day: 24, month: 3, year: 2015 },
    sowing: sowings[1],
    average: 9000,
    profit: 9000 * prices[0].price
  },
  {
    id: 3,
    date: { day: 11, month: 4, year: 2015 },
    sowing: sowings[2],
    average: 8500,
    profit: 8500 * prices[0].price
  },
  {
    id: 4,
    date: { day: 4, month: 4, year: 2015 },
    sowing: sowings[3],
    average: 9800,
    profit: 9800 * prices[0].price
  },
  {
    id: 5,
    date: { day: 17, month: 3, year: 2015 },
    sowing: sowings[4],
    average: 6000,
    profit: 6000 * prices[0].price
  },
  {
    id: 6,
    date: { day: 10, month: 4, year: 2015 },
    sowing: sowings[5],
    average: 6500,
    profit: 6500 * prices[0].price
  },
  {
    id: 7,
    date: { day: 23, month: 3, year: 2016 },
    sowing: sowings[6],
    average: 9000,
    profit: 9000 * prices[0].price
  },
  {
    id: 8,
    date: { day: 20, month: 3, year: 2016 },
    sowing: sowings[7],
    average: 8700,
    profit: 8700 * prices[0].price
  },
  {
    id: 9,
    date: { day: 2, month: 4, year: 2016 },
    sowing: sowings[8],
    average: 8800,
    profit: 8800 * prices[0].price
  },
  {
    id: 10,
    date: { day: 16, month: 2, year: 2016 },
    sowing: sowings[9],
    average: 9000,
    profit: 9000 * prices[0].price
  },
  {
    id: 11,
    date: { day: 24, month: 3, year: 2015 },
    sowing: sowings[10],
    average: 16000,
    profit: 16000 * prices[3].price
  },
  {
    id: 12,
    date: { day: 17, month: 3, year: 2015 },
    sowing: sowings[11],
    average: 18500,
    profit: 18500 * prices[3].price
  },
  {
    id: 13,
    date: { day: 9, month: 4, year: 2015 },
    sowing: sowings[12],
    average: 9000,
    profit: 9000 * prices[3].price
  },
  {
    id: 14,
    date: { day: 30, month: 3, year: 2015 },
    sowing: sowings[13],
    average: 12000,
    profit: 12000 * prices[3].price
  },
  {
    id: 15,
    date: { day: 12, month: 3, year: 2015 },
    sowing: sowings[14],
    average: 12500,
    profit: 12500 * prices[3].price
  },
  {
    id: 16,
    date: { day: 2, month: 3, year: 2015 },
    sowing: sowings[15],
    average: 14000,
    profit: 14000 * prices[3].price
  },
  {
    id: 17,
    date: { day: 30, month: 3, year: 2016 },
    sowing: sowings[16],
    average: 16000,
    profit: 16000 * prices[3].price
  },
  {
    id: 18,
    date: { day: 25, month: 3, year: 2016 },
    sowing: sowings[17],
    average: 14500,
    profit: 14500 * prices[3].price
  },
  {
    id: 19,
    date: { day: 14, month: 4, year: 2016 },
    sowing: sowings[18],
    average: 19000,
    profit: 19000 * prices[3].price
  },
  {
    id: 20,
    date: { day: 29, month: 4, year: 2016 },
    sowing: sowings[19],
    average: 8000,
    profit: 8000 * prices[3].price
  },
  {
    id: 21,
    date: { day: 14, month: 5, year: 2015 },
    sowing: sowings[20],
    average: 4000,
    profit: 4000 * prices[4].price
  },
  {
    id: 22,
    date: { day: 20, month: 5, year: 2015 },
    sowing: sowings[21],
    average: 5000,
    profit: 5000 * prices[4].price
  },
  {
    id: 23,
    date: { day: 30, month: 4, year: 2015 },
    sowing: sowings[22],
    average: 4500,
    profit: 4500 * prices[4].price
  },
  {
    id: 24,
    date: { day: 29, month: 4, year: 2015 },
    sowing: sowings[23],
    average: 2000,
    profit: 2000 * prices[4].price
  },
  {
    id: 25,
    date: { day: 4, month: 5, year: 2015 },
    sowing: sowings[24],
    average: 3500,
    profit: 3500 * prices[4].price
  },
  {
    id: 26,
    date: { day: 17, month: 4, year: 2015 },
    sowing: sowings[25],
    average: 3400,
    profit: 3400 * prices[4].price
  },
  {
    id: 27,
    date: { day: 23, month: 4, year: 2015 },
    sowing: sowings[26],
    average: 3900,
    profit: 3900 * prices[4].price
  },
  {
    id: 28,
    date: { day: 5, month: 4, year: 2016 },
    sowing: sowings[27],
    average: 3700,
    profit: 3700 * prices[4].price
  },
  {
    id: 29,
    date: { day: 20, month: 5, year: 2016 },
    sowing: sowings[28],
    average: 4000,
    profit: 4000 * prices[4].price
  },
  {
    id: 30,
    date: { day: 12, month: 5, year: 2016 },
    sowing: sowings[29],
    average: 5000,
    profit: 5000 * prices[4].price
  },
  {
    id: 31,
    date: { day: 2, month: 12, year: 2015 },
    sowing: sowings[30],
    average: 6000,
    profit: 6000 * prices[6].price
  },
  {
    id: 32,
    date: { day: 23, month: 11, year: 2015 },
    sowing: sowings[31],
    average: 3000,
    profit: 3000 * prices[6].price
  },
  {
    id: 33,
    date: { day: 25, month: 11, year: 2015 },
    sowing: sowings[32],
    average: 3500,
    profit: 3500 * prices[6].price
  },
  {
    id: 34,
    date: { day: 10, month: 12, year: 2015 },
    sowing: sowings[33],
    average: 3000,
    profit: 3000 * prices[6].price
  },
  {
    id: 35,
    date: { day: 20, month: 12, year: 2015 },
    sowing: sowings[34],
    average: 4400,
    profit: 4400 * prices[6].price
  },
  {
    id: 36,
    date: { day: 4, month: 12, year: 2015 },
    sowing: sowings[35],
    average: 5000,
    profit: 5000 * prices[6].price
  },
  {
    id: 37,
    date: { day: 30, month: 11, year: 2015 },
    sowing: sowings[36],
    average: 2500,
    profit: 2500 * prices[6].price
  },
  {
    id: 38,
    date: { day: 20, month: 11, year: 2015 },
    sowing: sowings[37],
    average: 4000,
    profit: 4000 * prices[6].price
  },
  {
    id: 39,
    date: { day: 23, month: 11, year: 2015 },
    sowing: sowings[38],
    average: 3500,
    profit: 3500 * prices[6].price
  },
  {
    id: 40,
    date: { day: 12, month: 12, year: 2015 },
    sowing: sowings[39],
    average: 3200,
    profit: 3200 * prices[6].price
  }
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
        url: Routing.generate('get_lotes'),
        success: function (data) {
            window.lots = data;
        }
    });
//    const lots = window.lots;
    
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
//    const sowings = window.sowings;
    
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
//    const harvests = window.harvests;
    
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
