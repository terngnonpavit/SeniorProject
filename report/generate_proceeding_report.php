<?php
require('fpdf.php');

class PDF_HTML extends FPDF {
    var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN='';
		function conv($string) {
			return iconv('UTF-8', 'TIS-620', $string);
		}

		function SetThaiFont() {
			$this->AddFont('AngsanaNew','','angsa.php');
			$this->AddFont('AngsanaNew','B','angsab.php');
			$this->AddFont('AngsanaNew','I','angsai.php');
			$this->AddFont('AngsanaNew','IB','angsaz.php');
			$this->AddFont('CordiaNew','','cordia.php');
			$this->AddFont('CordiaNew','B','cordiab.php');
			$this->AddFont('CordiaNew','I','cordiai.php');
			$this->AddFont('CordiaNew','IB','cordiaz.php');
			$this->AddFont('Tahoma','','tahoma.php');
			$this->AddFont('Tahoma','B','tahomab.php');
			$this->AddFont('BrowalliaNew','','browa.php');
			$this->AddFont('BrowalliaNew','B','browab.php');
			$this->AddFont('BrowalliaNew','I','browai.php');
			$this->AddFont('BrowalliaNew','IB','browaz.php');
			$this->AddFont('KoHmu','','kohmu.php');
			$this->AddFont('KoHmu2','','kohmu2.php');
			$this->AddFont('KoHmu3','','kohmu3.php');
			$this->AddFont('MicrosoftSansSerif','','micross.php');
			$this->AddFont('PLE_Cara','','plecara.php');
			$this->AddFont('PLE_Care','','plecare.php');
			$this->AddFont('PLE_Care','B','plecareb.php');
			$this->AddFont('PLE_Joy','','plejoy.php');
			$this->AddFont('PLE_Tom','','pletom.php');
			$this->AddFont('PLE_Tom','B','pletomb.php');
			$this->AddFont('PLE_TomOutline','','pletomo.php');
			$this->AddFont('PLE_TomWide','','pletomw.php');
			$this->AddFont('DilleniaUPC','','dill.php');
			$this->AddFont('DilleniaUPC','B','dillb.php');
			$this->AddFont('DilleniaUPC','I','dilli.php');
			$this->AddFont('DilleniaUPC','IB','dillz.php');
			$this->AddFont('EucrosiaUPC','','eucro.php');
			$this->AddFont('EucrosiaUPC','B','eucrob.php');
			$this->AddFont('EucrosiaUPC','I','eucroi.php');
			$this->AddFont('EucrosiaUPC','IB','eucroz.php');
			$this->AddFont('FreesiaUPC','','free.php');
			$this->AddFont('FreesiaUPC','B','freeb.php');
			$this->AddFont('FreesiaUPC','I','freei.php');
			$this->AddFont('FreesiaUPC','IB','freez.php');
			$this->AddFont('IrisUPC','','iris.php');
			$this->AddFont('IrisUPC','B','irisb.php');
			$this->AddFont('IrisUPC','I','irisi.php');
			$this->AddFont('IrisUPC','IB','irisz.php');
			$this->AddFont('JasmineUPC','','jasm.php');
			$this->AddFont('JasmineUPC','B','jasmb.php');
			$this->AddFont('JasmineUPC','I','jasmi.php');
			$this->AddFont('JasmineUPC','IB','jasmz.php');
			$this->AddFont('KodchiangUPC','','kodc.php');
			$this->AddFont('KodchiangUPC','B','kodc.php');
			$this->AddFont('KodchiangUPC','I','kodci.php');
			$this->AddFont('KodchiangUPC','IB','kodcz.php');
			$this->AddFont('LilyUPC','','lily.php');
			$this->AddFont('LilyUPC','B','lilyb.php');
			$this->AddFont('LilyUPC','I','lilyi.php');
			$this->AddFont('LilyUPC','IB','lilyz.php');
			$this->AddFont('THSarabunNew','','THSarabunNew.php');
			$this->AddFont('THSarabunNew','B','THSarabunNew_b.php');
			$this->AddFont('THSarabunNew','I','THSarabunNew_i.php');
			$this->AddFont('THSarabunNew','IB','THSarabunNew_bi.php');
		}

    function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Cell(0,5,$e,0,1,'C');
                else
                    $this->Write(5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$prop);
                }
            }
        }
    }

    function OpenTag($tag,$prop)
    {
        //Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF=$prop['HREF'];
        if($tag=='BR')
            $this->Ln(6.5);
        if($tag=='P'){
            $this->ALIGN=$prop['ALIGN'];
            $this->Ln(2);
        }
        if($tag=='HR')
        {
            if( !empty($prop['WIDTH']) )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }

    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
}

// $pdf = new PDF();
// $pdf->AddPage();
// $pdf->SetFont('Arial', 'B', 16);
// $pdf->Cell(40, 10, "Hello World ❏");
//
// $pdf->SetThaiFont();
//
// $pdf->SetFont('THSarabunNew', 'IBU', 16);
// $txt = $pdf->conv("สวัสดีชาวโลก");
// $pdf->cell(10, 20, $txt);
//
// $pdf->AddPage();
// $pdf->SetFont('THSarabunNew', 'B', 16);
// $txt = $pdf->conv("สวัสดีชาวโลก");
// $pdf->cell(20, 30, $txt);
// $pdf->Ln(20);

// $pdf->SetFont('THSarabunNew', 'I', 16);
// $txt = $pdf->conv("สวัสดีชาวโลก");
// $pdf->cell(30, 40, $txt);
// $pdf->SetFont('Arial');
// $str = iconv('UTF-8', 'windows-1252', html_entity_decode("&Omicron;"));
// $str = mb_convert_encoding("&Omicron;", 'UTF-8', 'HTML-ENTITIES');
// $pdf->cell(35, 40, $str);

// $pdf->SetFont('THSarabunNew', 'IB', 16);
// $txt = $pdf->conv("สวัสดีชาวโลก");
// $special = $pdf->special_conv(" ❏");
// $pdf->cell(40, 50, $txt . $special);
// $pdf->Output();
// echo $_POST['titleTH'];
