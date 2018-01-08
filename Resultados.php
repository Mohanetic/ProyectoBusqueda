<?php 
  require 'simple_html_dom.php';
            
    function ImgResize($imagen) {
        
        $xpath = new DOMXPath(@DOMDocument::loadHTML($imagen));
        $src = $xpath->evaluate("string(//img/@src)");

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
        $text = strip_tags($valor);

        return $tituloNuevo = "<a href='$href'>$text</a>";
    }

    //-------------------------------------------------------------------------------------
    
    if (isset($_POST['Buscador'])) {
        
      $busqueda = $_POST['Buscador'];

      $counter = 1 ;

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

        echo "<ul style='list-style: none; border:5px solid #448996; height: 350px; width:350px; float: left; margin: 5px;'>
                <li> $titulo </li> </br>
                <li> <img src='$NuevaSrc' Style='width: 50%;'> </li> </br> 
                <li>Precio: $valor </li> <br/> 
              </ul>";
      }

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

          echo "<ul style='list-style: none; border:5px solid #448996; height: 350px; width:350px; float: left; margin: 5px;'>
                  <li> $NuevoTitulo </li> </br>
                  <li> <img src='$NuevaSrc' Style='width: 50%;'> </li> </br>
                  <li>Precio: $valor </li> <br/> 
                </ul>";
      }
    }
?>