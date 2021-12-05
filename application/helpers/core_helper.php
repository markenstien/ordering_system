<?php
     
     function sort_items($items , $sort_on , $type = 'DESC')
     {
          $ret_val = array_column((array) $items, $sort_on);

          array_multisort($ret_val, $type == 'DESC' ? SORT_DESC : SORT_ASC , $items);

          return $ret_val;
     }     
     function e_user_type($user_data)
     {
        $type = null;
        switch($user_data['user_type'])
        {
          case 'employee'://cashier
            $type = 'cashier';
            break;
          case 'admin':
            $type = 'admin';
            break;
          case 'customer':
            $type = 'customer';
            break;
        }

        return $type;
     }    

     function paypal($key = null)
     {
        $items = [
          'sandbox_account' => 'sb-0knjy3991047@business.example.com',
          'client_id'  => 'AeTxGYye5QLyXZokGiE4hhND5GEeu3dxePRXiqa921Sv0z3fz3dWdOCfjF9ChHOd0ldZLq45zxp8f4B4',
          'secret' => 'ENCFd2oWwgazJZyWO3EIqyv_gcU9_yLiSRTyU1_N9u4uzDA2FBN6I-Djciq-e9eAHzuL6L3jlDOM5_Fd'
        ];

        return is_null($key) ? $items : $items[$key];
     }          

     function generateRandomString($length = 10) {
         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $charactersLength = strlen($characters);
         $randomString = '';
         for ($i = 0; $i < $length; $i++) {
             $randomString .= $characters[rand(0, $charactersLength - 1)];
         }
         return $randomString;
     }

     function amountHTML($amount)
     {
          echo number_format($amount , 2);
     }     

     function flash_set($message , $type = 'success', $name = 'flash')
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
                    <div class="alert alert-dismissible alert-{$type}">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
     function btnLink( $href , $text , $type = '' , $icon_param = null)
     {
          $icon = '';
          $color = '';

          switch ( strtolower($type) ) {
               case 'edit':
               case 'primary':
                    $icon = 'pencil';
                    $color = 'primary';
                    break;

               case 'create':
                    $icon = 'plus';
                    $color = 'primary';
                    break;

               case 'warning':
                    $icon = 'return';
                    $color = 'warning';
                    break;


               case 'delete':
               case 'cancel':
               case 'danger':
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

               case 'success':
               case 'confirmed':
                    $icon = 'checked';
                    $color = 'success';
                    break;
               default:
                    $icon = '';
                    $color = 'primary';
                    break;
          }

          $href = base_url($href);

          if( !is_null($icon_param) ){
               $icon = $icon_param;
          }else{
               $icon = 'fa fa-'.$icon;
          }

          print <<<EOF
           <a href="{$href}" class="btn btn-{$color}"><i class="{$icon}"></i> {$text}</a>
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