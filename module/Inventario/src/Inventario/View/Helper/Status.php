<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inventario\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\I18n\View\Helper\DateFormat;



class Status extends AbstractHelper
{

    public  function invoke($status = null)
    {

        if ($status == true){
            echo '<img src="data:image/gif;base64,R0lGODlhEAAQALMPAJy4ZKvoZrLtbcT8fqXjYMrumMj/gc3xnLnzc9Hzob/4edX2p9n5q+D9s937sP///yH5BAEAAA8ALAAAAAAQABAAAAQ38MlJq704awrAloBheBowDA2JAYriqFMHIggDg4LQ5csNJoFgIOGLHQiEQ5FTKCwrso90SpVEAAA7" alt="On" />';
        }else{
            echo '<img src="data:image/gif;base64,R0lGODlhEAAQALMNALhkZPh5efx+fu6YmOhmZvNzc/+BgeNgYO1tbfOhof2zs/GcnPuwsP///wAAAAAAACH5BAEAAA0ALAAAAAAQABAAAAQ+sMlJq704XwAo34bRNUA4eoogcKpyekwgB8xbAUVe2DfiI7wJgEBIJIhBwOGw4CyWPMBgMJJSN6+PZsvtViIAOw==" alt="Off" />';
        }
    }

    public function explode($string = null)
    {

        $patrón = '/;/';
        $sustitución = '</br>';
        $datos = preg_replace($patrón, $sustitución, $string);

        return $datos;
    }

    public function comprobar($status = null)
    {

        if($status == 'success'){
            echo '<span class="label label-success">Aprobado</span>';
        }elseif ($status == 'warning'){
            echo '<span class="label label-warning">Pendiente</span>';
        }elseif ($status == 'danger'){
            echo '<span class="label label-danger">No Aprobado</span>';
        }
    }

    public function btstatus($status = null)
    {

        if($status == 'success'){
            echo '<button type="button" class="btn btn-success"><span class="glyphicon glyphicon-check"></span><b> Aprobado</b></button>';
        }elseif ($status == 'warning'){
            echo '<button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-minus"></span><b> Pendiente de Aprobación</b></button>';
        }elseif ($status == 'danger'){
            echo '<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-ban-circle"></span><b> No Aprobado</b></button>';
        }else{
            echo '<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-exclamation-sign"></span><b>'.$status.'</b></button>';
        }
    }
    
    public function printdate($date = 'now')
    {
        $dateFormat = new DateFormat();

        echo $dateFormat(
            new \DateTime($date),
            \IntlDateFormatter::MEDIUM, // date
            \IntlDateFormatter::MEDIUM, // time
            "en_US"
        );
    }
    
    public function  getip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        return $_SERVER['HTTP_CLIENT_IP'];
        }
        
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        
        return $_SERVER['REMOTE_ADDR'];
    }

}
