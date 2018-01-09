<?php 
  require 'simple_html_dom.php';
            
    function ImgResize($imagen) {
        
        $xpath = new DOMXPath(@DOMDocument::loadHTML($imagen));
        $src = $xpath->evaluate("string(//img/@src)");

        preg_match('/(src=["\'](.*?)["\'])/', $imagen, $match);  //find src="X" or src='X'
        $split = preg_split('/["\']/', $match[0]); // split by quotes

        $src = $split[1]; // X between quotes

        return $src;
    }

    function TitleStyle($titulo) {
        
        $xpath = new DOMXPath(@DOMDocument::loadHTML($titulo));
        $href = $xpath->evaluate("string(//a/@href)");
        $text = strip_tags($titulo);

        return $tituloNuevo = "<a href='$href'>$text</a>";
    }

    function ValueStyle($valor) {
        
        $xpath = new DOMXPath(@DOMDocument::loadHTML($valor));
        $valor2 = strip_tags($valor);

        $valor3 = explode('$', $valor2);

        return $ValorNuevo = number_format($valor3[1]);
      }

    function sort_by_orden ($a, $b) {



       return $a['Precio'] - $b['Precio'];
    }

    //-------------------------------------------------------------------------------------
    
    if (isset($_POST['Buscador'])) {
        
      $busqueda = $_POST['Buscador'];

      $counter = 0 ;

      $html = new simple_html_dom();

      if (empty($busqueda)) {
        $busqueda = "monitor";
      }

      $url = 'https://www.solotodo.com/search/?keywords='. $busqueda;

      $html = file_get_html($url);

      $titles = $html->find('div[class=search_result]');

      foreach($titles as $title )
      {
        $titulo = $title->find('h4 a',0);
        $imagen = $title->find('a img',0);
        $valor  = $title->find('div[class=with_margin_top] a',0);

        $NuevoTitulo = TitleStyle($titulo);
        $NuevaSrc = ImgResize($imagen);
        $NuevoValor = ValueStyle($valor);

        $datos[$counter]["Titulo"] = $NuevoTitulo;
        $datos[$counter]["Imagen"] = $NuevaSrc;
        $datos[$counter]["Precio"] = $NuevoValor;
        $datos[$counter]["Tienda"] = "SoloTodo";

        $counter++;
      }

      //---------------------------------------------------------------------------------------------------------------------------------------

      $url = 'https://busqueda.paris.cl/busca?storeId=10801&catalogId=40000000629&langId=-5&pageSize=30&beginIndex=0&searchSource=Q&sType=SimpleSearch&resultCatEntryType=2&showResultsPage=true&pageView=image&q='. $busqueda;

      $html = file_get_html($url);

      $titles = $html->find('li[class=nm-product-item]');

      foreach($titles as $title )
      {   
          $valor  = $title->find('div[class=nm-price-value]',0);
          $titulo = $title->find('h2 a',0);
          $imagen = $title->find('div[class=nm-product-img-container] a img',0);
          
          $NuevoTitulo = TitleStyle($titulo);
          $NuevaSrc = ImgResize($imagen);
          $NuevoValor = ValueStyle($valor);

          $datos[$counter]["Titulo"] = $NuevoTitulo;
          $datos[$counter]["Imagen"] = $NuevaSrc;
          $datos[$counter]["Precio"] = $NuevoValor;
          $datos[$counter]["Tienda"] = "Paris";

          $counter++;
      }

      //---------------------------------------------------------------------------------------------------------------------------------------

      $url = 'https://simple.ripley.cl/search/'. $busqueda;

      $html = file_get_html($url);

      $titles = $html->find('a[class=catalog-product]');

      foreach($titles as $title )
      {   
          $valor  = $title->find('span[class=catalog-product-offer-price]',0);
          $titulo = $title->find('span[class=js-clamp catalog-product-name]',0);
          $imagen = $title->find('div[class=product-image-wrapper] img',0);
          
          $NuevoTitulo = TitleStyle($title);
          $NuevaSrc = ImgResize($imagen);
          $NuevoValor = ValueStyle($valor);

          $datos[$counter]["Titulo"] = $NuevoTitulo;
          $datos[$counter]["Imagen"] = $NuevaSrc;
          $datos[$counter]["Precio"] = $NuevoValor;
          $datos[$counter]["Tienda"] = "Ripley";

          $counter++;
      }

      //---------------------------------------------------------------------------------------------------------------------------------------

      uasort($datos, 'sort_by_orden');

      $longitud = count($datos);

      for($i=0; $i<$longitud; $i++)
      {
        echo "<ul style='list-style: none; border:5px solid #448996; height: 300; width:350px; float: left; margin: 5px;padding: 0;'>
                <li Style='height:25px; font-size:14px;'> " .$datos[$i]["Titulo"]. " </li> </br>
                <li Style='height:150px;'> <img src='" .$datos[$i]["Imagen"]. "' Style='width: 50%; display: block; margin-left: auto; margin-right: auto;'> </li> </br>
                <li Style='height:25px;'>Precio: $" .$datos[$i]["Precio"]. ".-</li> <br/> 
                <li Style='height:25px;'><p style='float: right;'>" .$datos[$i]["Tienda"]. "</p> </li>
              </ul>";
      }
    }
?>