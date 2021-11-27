<?php
     

     function flast_set($message , $type = 'success', $name = 'flash')
     {
          $_SESSION['flash_message'] = $message;
          $_SESSION['flash_type'] = $type;
          $_SESSION['flash_name'] = $name;
     }

     function flash()
     {
          if( isset($_SESSION['flash_message']) )
          {
               $message = $_SESSION['flash_message'];
               $type = $_SESSION['flash_type'];

               print <<<EOF
                    <div class="alert alert-{$type} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {$message}
                      </div>
               EOF;

               unset($_SESSION['flash_message']);
               unset($_SESSION['flash_type']);
               unset($_SESSION['flash_name']);
          }
     }
     

     function flash_em()
     {
          require_once APPPATH.'/views/templates/partial/messages.php';
     }
    function str_escape($value)
    {
        $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

        return str_replace($search, $replace, $value);
    }
     
    function isSubmitted()
    {
        $request = $_SERVER['REQUEST_METHOD'];

        if( strtolower($request) === 'post'){
          f_preserve();
          return true;
        }

        return false;
    } 

    function isEqual($subject , $toMatch)
    {
        $subject = strtolower(trim($subject));

        if(is_array($toMatch))
         return in_array($subject , array_map('strtolower', $toMatch));
        return $subject === strtolower(trim($toMatch));
    }

     function dd($array){
          echo "<pre>";
          print_r($array);
          echo "</pre>";
          die;
     }


     /*
     *Edit
     *Delete
     *View
     *Submit
     */
     function btnLink( $href , $text , $type = '')
     {
          $icon = '';
          $color = '';

          switch ( strtolower($type) ) {
               case 'edit':
                    $icon = 'pencil';
                    $color = 'primary';
                    break;
               case 'delete':
                    $icon = 'trash';
                    $color = 'danger';
                    break;
               case 'view':
                    $icon = 'eye';
                    $color = 'primary';
                    break;
               case 'list':
                    $icon = 'list';
                    $color = 'primary';
                    break;
               default:
                    $icon = '';
                    $color = 'primary';
                    break;
          }

          $href = base_url($href);
          print <<<EOF
           <a href="{$href}" class="btn btn-{$color}"><i class="fa fa-{$icon}"></i> {$text}</a>
          EOF;
     }

     function __($data)
    {
        if( is_array($data) )
        {
            foreach($data as $d)
                echo $d;
        }else
        {
            echo $data;
        }
    }
?>