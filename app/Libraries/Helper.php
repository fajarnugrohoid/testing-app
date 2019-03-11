<?php 
namespace App\Libraries;

use Spipu\Html2Pdf\Html2Pdf;

class Helper
{
    public static function upload_file($file, $folder='default'){
		$result    = '';
		$file_name = '';

    	if($file){
			$file_name = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$date      = date('H:i:s');
	    	$result = $file->storeAs('public/'.$folder, md5($file_name . $date).'.'.$extension);
    	}

    	$data = [
			'url'       => str_replace('public/', '', $result),
			'file_name' => $file_name
    	];

    	return $data; 
    }

    public static function download_file(){
    	return \Storage::download('file/default/96886efd3254cab3bd0c12285819c764.jpeg');
    }

    /* utilitas */
    public static function encrypt($str)
    {
        $hasil = '';
        // $kunci = '979a218e0632df2935317f98d47956c7';
        $kunci = config('app.key');
        for ($i = 0; $i < strlen($str); $i++) {
            $karakter = substr($str, $i, 1);
            $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
            $karakter = chr(ord($karakter)+ord($kuncikarakter));
            $hasil .= $karakter;
            
        }

        return urlencode(base64_encode($hasil));
    }

    public static function decrypt($str)
    {
        $str = base64_decode(urldecode($str));
        $hasil = '';

        // $kunci = '979a218e0632df2935317f98d47956c7';
        $kunci = config('app.key');
        for ($i = 0; $i < strlen($str); $i++) {
            $karakter = substr($str, $i, 1);
            $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
            $karakter = chr(ord($karakter)-ord($kuncikarakter));
            $hasil .= $karakter;
            
        }

        return $hasil;
    }

    public static function printToPdf($contentView, $option=[])
    {   
        $default_config['filename'] = 'print';
        $default_config['page']     = 'P'; //P Page atau L lanscape
        
        $option = array_merge($default_config, $option);

        ob_start();
        ob_end_clean();

        $html2pdf = New Html2Pdf($option['page'], 'A4', 'fr', true, 'UTF-8', array(5, 2, 5, 2));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($contentView);
        $html2pdf->output($option['filename'].'.pdf');
    }
}
