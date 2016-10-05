<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Zend\Json\Expr;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
    	
    	$cultivos = $this->getPorcentajeCultivo();
    	$economia = $this->getUltimosResultadosEconomicos();
    	$promedios = $this->getPromediosAnuales();
    	$lotes = $this->getSuperficies();

        return $this->render('BackBundle:Default:index.html.twig', array('cultivos' => $cultivos, 'economia' => $economia, 'promedios' => $promedios, 'lotes' => $lotes));
    }

    public function getSuperficies()
    {
    	$usuario = $this->getUser();

    	$sql = "SELECT l.nombre lote, l.superficie FROM lote l
    			WHERE usuario_id = " . $usuario->getId();

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

    	$cultivos = $stmt->fetchAll();

    	$data = [];
    	foreach ($cultivos as $key => $c) {
    		$data[] = array($c["lote"], (int)$c["superficie"]);
    	}

    	$ob = new Highchart();
		$ob->chart->renderTo('lotes');
		$ob->title->text('Porcentaje de superficie por lote');
		$ob->plotOptions->pie(array(
		    'allowPointSelect'  => true,
		    'cursor'    => 'pointer',
		    'dataLabels'    => array('enabled' => false),
		    'showInLegend'  => true
		));

		$ob->series(array(array('type' => 'pie','name' => 'Porcentaje de superficie/lote', 'data' => $data)));

    	return $ob;
    }

    public function getPromediosAnuales()
    {
    	$sql = "SELECT cul.nombre cultivo, avg(c.rinde) rinde FROM lote l
    			JOIN siembra s ON s.lote_id = l.id
    			JOIN cosecha c ON c.siembra_id = s.id
    			JOIN cultivo cul ON cul.id = s.cultivo_id
    			WHERE year(c.fecha) = " . date("Y") . " 
    			GROUP BY cul.id";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

    	$promedios = $stmt->fetchAll();

    	foreach ($promedios as $key => $p) {
    		$promedio[] = (int)$p["rinde"];
			$cultivo[] = $p["cultivo"];
    	}

    	$series = array(
					    array(
					        'name'  => 'Rinde',
					        'type'  => 'column',
					        'color' => '#4572A7',
					        'yAxis' => 1,
					        'data'  => $promedio,
					    )
				);

		$yData = array(
		    array(
		        'labels' => array(
		            'formatter' => new Expr('function () { return this.value + " degrees C" }'),
		            'style'     => array('color' => '#AA4643')
		        ),
		        'title' => array(
		            'text'  => '',
		            'style' => array('color' => '#AA4643')
		        ),
		        'opposite' => true,
		    ),
		    array( ),
		);
		$categories = $cultivo;

		$ob = new Highchart();
		$ob->chart->renderTo('promedios'); // The #id of the div where to render the chart
		$ob->chart->type('column');
		$ob->title->text('Promedios de rendimiento por cultivo para el año ' . date("Y"));

		$ob->xAxis->categories($categories);
		$ob->yAxis($yData);

		$ob->series($series);

		return $ob;
    }

    public function getUltimosResultadosEconomicos()
    {
    	$usuario = $this->getUser();

    	$sql = "SELECT s.costo, c.beneficio FROM lote l
    			JOIN siembra s ON s.lote_id = l.id
    			JOIN cosecha c ON c.siembra_id = s.id
    			WHERE usuario_id = " . $usuario->getId(). " LIMIT 10";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

    	$economia = $stmt->fetchAll();

    	foreach ($economia as $key => $e) {
    		$costo[] = (int)$e["costo"];
    		$beneficio[] = (int)$e["beneficio"];
    	}

    	//print_r($costo);die;

    	// Chart
	    $series = array(
	        array("name" => "Costo", "data" => array_reverse($costo)),

	        array("name" => "Beneficio", "data" => array_reverse($beneficio))
	    );

	    $ob = new Highchart();
	    $ob->chart->renderTo('economia');  // The #id of the div where to render the chart
	    $ob->title->text('Últimos resultados economicos');
	    $ob->xAxis->title(array('text'  => "Últimas siembras (de más antigua a más nueva)"));
	    $ob->yAxis->title(array('text'  => "Dinero"));
	    $ob->series($series);

	    return $ob;
    }

    public function getPorcentajeCultivo()
    {
    	$usuario = $this->getUser();

    	$sql = "SELECT c.nombre cultivo, sum(l.superficie) superficie FROM lote l
    			JOIN siembra s ON s.lote_id = l.id
    			JOIN cultivo c ON c.id = s.cultivo_id
    			WHERE usuario_id = " . $usuario->getId() . "
    			GROUP BY c.id";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

    	$cultivos = $stmt->fetchAll();

    	$data = [];
    	foreach ($cultivos as $key => $c) {
    		$data[] = array($c["cultivo"], (int)$c["superficie"]);
    	}

    	$ob = new Highchart();
		$ob->chart->renderTo('cultivos');
		$ob->title->text('Porcentaje de hectareas sembradas por grano');
		$ob->plotOptions->pie(array(
		    'allowPointSelect'  => true,
		    'cursor'    => 'pointer',
		    'dataLabels'    => array('enabled' => false),
		    'showInLegend'  => true
		));

		$ob->series(array(array('type' => 'pie','name' => 'Porcentaje de cultivos', 'data' => $data)));

    	return $ob;
    }
}
