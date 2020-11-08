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
            $this->Ln(3);
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
// echo $row['titleTH'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id=$_GET['id'];
$save=$_GET['save'];
$sql = "select * from scholarship_proceeding where id=$id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc())  {
    $author=$row['author'];
    $department=$row['department'];
    $titleTH=$row['titleTH'];
    $titleEN=$row['titleEN'];
    $conference_name=$row['conference_name'];
    $place=$row['place'];
    $date=$row['date'];
    $type_of_document=$row['type_of_document'];
    $type_of_publication=$row['type_of_publication'];
    $approval=$row['approval'];
    $participation=$row['participation'];
    $form_document=$row['form_document'];
    // $certification=$row['certification'];
    $amount=$row['amount'];
    $amount_text=$row['amount_text'];
    $applicant=$row['applicant'];
    $head_of_department=$row['head_of_department'];
    $department_name=$row['department_name'];
  }
}
$npdf=new PDF_HTML();
$npdf->AddPage();
$npdf->SetThaiFont();
$npdf->SetFont('THSarabunNew', '', '15');
$author=$npdf->conv($author);
$department=$npdf->conv($department);
$titleTH=$npdf->conv($titleTH);
$titleEN=$npdf->conv($titleEN);
$conference_name=$npdf->conv($conference_name);
$place=$npdf->conv($place);
$date=$npdf->conv($date);
// $type_of_document=$npdf->conv($type_of_document);
// $type_of_publication=$npdf->conv($type_of_publication);
// $approval=$npdf->conv($approval);
// $participation=$npdf->conv($participation);
// $form_document=$npdf->conv($form_document);
// $certification=$npdf->conv($certification);
$amount=$npdf->conv($amount);
$amount_text=$npdf->conv($amount_text);
$applicant=$npdf->conv($applicant);
$head_of_department=$npdf->conv($head_of_department);
$department_name=$npdf->conv($department_name);

// $npdf->SetFont('ZapfDingbats','', 10);
// $npdf->SetXY(50,50);
// $npdf->write(6.5,'4');
// $npdf->SetXY(50,50);
// $npdf->write(6.5,'q');

$npdf->SetFont('THSarabunNew', '', '14');
$righttop=$npdf->conv('(แบบฟอร์มขอรับการสนับสนุนเงินรางวัลสำหรับผลงานที่ตีพิมพ์เผยแพร่ตั้งแต่วันที่ 1 ตุลาคม 2561)');
$npdf->SetXY(65,7);
$npdf->write(1,"$righttop");

$npdf->WriteHTML("<br>");
$npdf->SetFont('THSarabunNew', '', '17');
$header1=$npdf->conv('แบบฟอร์มขอรับการสนับสนุนเงินรางวัลสำหรับการเผยแพร่ผลงาน');
$header2=$npdf->conv('จากกองทุนสนับสนุนการวิจัย นวัตกรรมและการสร้างสรรค์ คณะวิทยาศาสตร์');
$header3=$npdf->conv('ประเภท ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการ');

$npdf->WriteHTML("
<b><p align='center'>$header1</p></b>
<b><p align='center'>$header2</p></b>
<b><p align='center'>$header3</p></b>
");

$npdf->SetFont('THSarabunNew', '', '15');
$section1_1=$npdf->conv('ชื่อผู้ขอรับการสนับสนุน');
$section1_2=$npdf->conv("สังกัด");
$section1_3=$npdf->conv("ชื่อผลงานวิจัย");
$section1_4=$npdf->conv("ชื่อการประชุมวิชาการ");
$section1_5=$npdf->conv("สถานที่ วันเดือนปี ที่จัด");

$npdf->SetXY(15,43);
$npdf->write(6.5,"$section1_1");
$npdf->SetXY(51,42);
$npdf->write(6.5,"$author");
$npdf->SetXY(50,43);
$npdf->write(6.5,"...........................................................................................");
$npdf->SetXY(129,43);
$npdf->write(6.5,"$section1_2");
$npdf->SetXY(139,42);
$npdf->write(6.5,"$department");
$npdf->SetXY(138,43);
$npdf->write(6.5,"..........................................................");
$npdf->SetXY(15,51);
$npdf->write(6.5,"$section1_3");
$npdf->SetXY(51,50);
$npdf->write(6.5,"$titleEN");
$npdf->SetXY(50,51);
$npdf->write(6.5,".................................................................................................................................................................");
$npdf->SetXY(51,57);
$npdf->write(6.5,"$titleTH");
$npdf->SetXY(50,58);
$npdf->write(6.5,".................................................................................................................................................................");
$npdf->SetXY(15,66);
$npdf->write(6.5,"$section1_4");
$npdf->SetXY(51,65);
$npdf->write(6.5,"$conference_name");
$npdf->SetXY(50,66);
$npdf->write(6.5,".................................................................................................................................................................");
$npdf->SetXY(15,74);
$npdf->write(6.5,"$section1_5");
$npdf->SetXY(51,73);
$npdf->write(6.5,"$place $date");
$npdf->SetXY(50,74);
$npdf->write(6.5,".................................................................................................................................................................");

$section2=$npdf->conv('ประเภทของผลงาน');
$npdf->WriteHTML("<br><br><b>    $section2</b>");
//1
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,94);
if($type_of_document=="research_article"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(17,94);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,94);
$npdf->write(6.5,"Research Article");
//2
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(60,94);
if($type_of_document=="review_article"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(60,94);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(65,94);
$npdf->write(6.5,"Review Article");
//3
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(100,94);
if($type_of_document=="abstract"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(100,94);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(105,94);
$npdf->write(6.5,"Abstact");

$section3=$npdf->conv('ประเภทของการตีพิมพ์และการประชุมวิชาการ(เลือกเพียง 1 ประเภท)');
$section3_1=$npdf->conv('Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ รางวัลละไม่เกิน 3,000 บาท');
$section3_2=$npdf->conv('Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ        รางวัลละไม่เกิน 2,000 บาท');
$section3_3=$npdf->conv('บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาติ      รางวัลละไม่เกิน 1,500 บาท');
$section3_4=$npdf->conv('บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ             รางวัลละไม่เกิน 1,000 บาท');
$npdf->WriteHTML("<br><br><b>    $section3</b>");
//1
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,114);
if($type_of_publication=="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับนานาชาติ"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(17,114);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,114);
$npdf->write(6.5,"$section3_1");
//2
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,121);
if($type_of_publication=="Proceedings ตีพิมพ์ในเอกสารสืบเนื่องจาการประชุมวิชาการระดับชาติ"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(17,121);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,121);
$npdf->write(6.5,"$section3_2");
//3
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,128);
if($type_of_publication=="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับนานาชาติ"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(17,128);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,128);
$npdf->write(6.5,"$section3_3");
//4
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,135);
if($type_of_publication=="บทคัดย่อตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการระดับชาติ"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(17,135);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,135);
$npdf->write(6.5,"$section3_4");

$section4=$npdf->conv('การเป็นผลงานที่ใช้ขออนุมัติสิ้นสุดสัญญาโครงการที่ได้รับทุนอุดหนุนการวิจัยจากคณะวิทยาศาสตร์');
$section4_1=$npdf->conv('กรณีที่ 1');
$section4_2=$npdf->conv(' ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)');
$section4_3=$npdf->conv('กรณีที่ 2');
$section4_4=$npdf->conv(' เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)');
$npdf->WriteHTML("<br><br><b>    $section4</b>");
//1
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(40,155);
if($approval=="กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(40,155);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(25,155);
$npdf->write(6.5,"$section4_1");
$npdf->SetXY(45,155);
$npdf->write(6.5,"$section4_2");
//2
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(40,163);
if($approval=="กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(40,163);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(25,163);
$npdf->write(6.5,"$section4_3");
$npdf->SetXY(45,163);
$npdf->write(6.5,"$section4_4");
$npdf->SetXY(54,163);
$npdf->write(6.5,"____________________________________");

$section5=$npdf->conv('การมีส่วนร่วมในผลงาน');
$section5_1=$npdf->conv('กรณีที่ 1');
$section5_2=$npdf->conv('First Author   หรือ');
$section5_3=$npdf->conv(' Corresponding Author (ได้รับการสนับสนุนเต็มจำนวน)');
$section5_4=$npdf->conv('กรณีที่ 2');
$section5_5=$npdf->conv(' เป็นผู้ร่วมเขียน (ได้รับการสนับสนุนกึ่งหนึ่งของเงินรางวัลที่ได้รับจากหัวข้อก่อนหน้า)');
$npdf->WriteHTML("<br><br><b>    $section5</b>");
//1
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(40,183);
if($participation=="กรณีที่ 1 First Author"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(40,183);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(25,183);
$npdf->write(6.5,"$section5_1");
$npdf->SetXY(45,183);
$npdf->write(6.5,"$section5_2");
//2
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(76,183);
if($participation=="กรณีที่ 1 Corresponding Author"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(76,183);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(81,183);
$npdf->write(6.5,"$section5_3");
//3
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(40,191);
if($participation=="กรณีที่ 2 เป็นผู้ร่วมเขียน"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(40,191);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(25,191);
$npdf->write(6.5,"$section5_4");
$npdf->SetXY(44,191);
$npdf->write(6.5,"$section5_5");
$npdf->SetXY(68,191);
$npdf->write(6.5,"_________________________________________________");

$section6=$npdf->conv('รูปแบบของเอกสารที่เผยแพร่');
$npdf->WriteHTML("<br><br><b>    $section6</b>");
//1
$section6_1=$npdf->conv('รูปเล่ม หรือ หนังสือ');
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,211);
$form_document_arr=explode(',',$form_document);
foreach ($form_document_arr as $document) {
  if($document=='รูปเล่ม หรือ หนังสือ'){
    $npdf->write(6.5,'3');
  }
}
$npdf->SetXY(17,211);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,211);
$npdf->write(6.5,"$section6_1");
//2
$section6_2=$npdf->conv('ซีดี');
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(60,211);
$form_document_arr=explode(',',$form_document);
foreach ($form_document_arr as $document) {
  if($document=='ซีดี'){
    $npdf->write(6.5,'3');
  }
}
$npdf->SetXY(60,211);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(65,211);
$npdf->write(6.5,"$section6_2");
//3
$section6_3=$npdf->conv('เว็บไซต์');
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(85,211);
$form_document_arr=explode(',',$form_document);
foreach ($form_document_arr as $document) {
  if($document=='เว็บไซต์'){
    $npdf->write(6.5,'3');
  }
}
$npdf->SetXY(85,211);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(90,211);
$npdf->write(6.5,"$section6_3");
//4
$section6_4=$npdf->conv('อื่นๆ ระบุ');
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(115,211);
$form_document_arr=explode(',',$form_document);
foreach ($form_document_arr as $document) {
// echo $document.'5<br>';
  if($document!='รูปเล่ม หรือ หนังสือ' && $document!='ซีดี' && $document!='เว็บไซต์' && $document!=''){
    $npdf->write(6.5,'3');
    $npdf->SetXY(135,210);
    $npdf->SetFont('THSarabunNew', '', '15');
    $npdf->write(6.5,"$document");
  }
}
$npdf->SetXY(115,211);
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(120,211);
$npdf->write(6.5,"$section6_4");
$npdf->SetXY(134,211);
$npdf->write(6.5,"...................");

$section7=$npdf->conv('เอกสารแนบ');
$section7_1=$npdf->conv('(ต้องมีทุกรายการ)');
$section7_2=$npdf->conv('- สำนวนหน้าปกเอกสารประกอบการประชุมวิชาการหรือรายงานสืบเนื่องจากการประชุมวิชาการ');
$section7_3=$npdf->conv('- สำเนารายชื่อกองบรรณาธิการจัดทำรายงาน หรือคณะกรรมการจัดการประชุม');
$section7_4=$npdf->conv('- สำเนากำหนดการนำเสนอผลงานที่ปรากฏชื่อผลงานที่ขอรับการสนับสนุน');
$section7_5=$npdf->conv('- ในกรณี');
$section7_6=$npdf->conv('ที่มี');
$section7_7=$npdf->conv('สำเนาผลงานวิจัยฉบับที่ตีพิมพ์เป็นดิจิตอลไฟล์ แนบมาเฉพาะสำเนาหน้าแรกของผลงานและหน้าที่');
$section7_8=$npdf->conv('ปรากฏชื่อผู้เขียน แล้วส่งไฟล์ผลงานวิจัยมายัง scisilpakorn@gmail.com');
$section7_9=$npdf->conv('หรือ');
$section7_10=$npdf->conv('ในกรณี');
$section7_11=$npdf->conv('ที่ไม่มี');
$section7_12=$npdf->conv('สำเนาผลงานวิจัยเป็นดิจิตอลไฟล์ แนบสำเนาผลงานที่ตีพิมพ์ทั้งฉบับ');

$npdf->WriteHTML("<br><br><b>    $section7</b> $section7_1<br><br>
        $section7_2<br>
        $section7_3<br>
        $section7_4<br>
        $section7_5<b><u>$section7_6</u></b>$section7_7<br>
          $section7_8 <b>$section7_9</b><br>
          $section7_10<b><u>$section7_11</u></b>$section7_12
");

$section8=$npdf->conv('การรับรองผลงาน');
$section8_1=$npdf->conv('ข้าพเจ้าขอรับรองว่า ผลงานเรื่องดังกล่าวข้างต้น เป็นไปตามหลักเกณฑ์ เงื่อนไข และวิธีการสนับสนุนเงินรางวัล');
$section8_2=$npdf->conv('หรือเงินสมนาคุณจากกองทุนสนับสนุนการวิจัย นวัตกรรมและการสร้างสรรค์ คณะวิทยาศาสตร์ ดังนี้');
$section8_3=$npdf->conv('เป็นผลงานที่เกิดขึ้นในระหว่างที่ผู้ขอรับการสนับสนุนปฏิบัติงานที่คณะวิทยาศาสตร์ มหาวิทยาลัยศิลปากร และ');
$section8_4=$npdf->conv('ไม่เป็นส่วนหนึ่งของวิทยานิพนธ์เพื่อสำเร็จการศึกษาในระดับใด ๆ ของผู้ขอรับการสนับสนุน');
$section8_5=$npdf->conv('ที่อยู่ของผู้ขอรับการสนับสนุนในผลงานปรากฏชื่อ คณะวิทยาศาสตร์ มหาวิทยาลัยศิลปากร เป็นอย่างน้อย');
$section8_6=$npdf->conv('เป็นผลงานที่ตีพิมพ์ในเอกสารสืบเนื่องจากการประชุมวิชาการที่มี peer-review');
$section8_7=$npdf->conv('ผลงานเรื่องดังกล่าวตีพิมพ์เผยแพร่มาแล้วเป็นระยะเวลาไม่เกิน 1 ปี นับถึงวันที่ยื่นขอรับการสนับสนุน และไม่เคย');
$section8_8=$npdf->conv('ได้รับการสนับสนุนเงินรางวัลหรือเงินสมนาคุณประเภทใด ๆ จากคณะวิทยาศาสตร์ มหาวิทยาลัยศิลปากร');
$section8_9=$npdf->conv('ข้าพเจ้าขอรับการสนับสนุนเงินรางวัลการเผยแพร่ผลงานดังกล่าว จากกองทุนสนับสนุนการวิจัย นวัตกรรมและ');
$section8_10=$npdf->conv('การสร้างสรรค์ คณะวิทยาศาสตร์ เป็นจำนวนเงิน');
$section8_11=$npdf->conv('บาท');
$section8_12=$npdf->conv('ลงชื่อ ');
$section8_13=$npdf->conv('ผู้ขอรับการสนับสนุน');
$section8_14=$npdf->conv('หัวหน้าภาควิชา');

$npdf->WriteHTML("
<br><br><b>    $section8</b><br>              $section8_1<br>$section8_2");
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(15,30);
$npdf->write(6.5,'3');
$npdf->SetXY(15,30);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(20,30);
$npdf->write(6.5,"$section8_3");
$npdf->SetXY(20,38);
$npdf->write(6.5,"$section8_4");

$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(15,46);
$npdf->write(6.5,'3');
$npdf->SetXY(15,46);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(20,46);
$npdf->write(6.5,"$section8_5");

$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(15,54);
$npdf->write(6.5,'3');
$npdf->SetXY(15,54);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(20,54);
$npdf->write(6.5,"$section8_6");

$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(15,62);
$npdf->write(6.5,'3');
$npdf->SetXY(15,62);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(20,62);
$npdf->write(6.5,"$section8_7");
$npdf->SetXY(20,70);
$npdf->write(6.5,"$section8_8");

$npdf->SetXY(23,90);
$npdf->write(6.5,"$section8_9");
$npdf->SetXY(11,97);
$npdf->write(6.5,"$section8_10");
$npdf->SetXY(85,96);
$npdf->write(6.5,"$amount");
$npdf->SetXY(102,97);
$npdf->write(6.5,"$section8_11");
$npdf->SetXY(78,97);
$npdf->write(6.5,"...........................");
$npdf->SetXY(126,96);
$npdf->write(6.5,"$amount_text");
$npdf->SetXY(110,97);
$npdf->write(6.5,"(..............................................................)");

$npdf->SetXY(100,120);
$npdf->write(6.5,"$section8_12");
$npdf->SetXY(108,120);
$npdf->write(6.5,"..............................................................");
$npdf->SetXY(120,129);
$npdf->write(6.5,"$applicant");
$npdf->SetXY(105,130);
$npdf->write(6.5,"(....................................................................)");
$npdf->SetXY(120,140);
$npdf->write(6.5,"$section8_13");

$section9=$npdf->conv('คำรับรองจากหัวหน้าภาควิชา/หัวหน้างาน');
$section9_1=$npdf->conv('ข้าพเจ้าขอรับรองว่าข้อความดังกล่าวข้างต้นเป็นจริงทุกประการ และผลงานดังกล่าวสมควรได้รับการสนับสนุน');
$section9_2=$npdf->conv('เงินรางวัลการเผยแพร่ผลงานจากกองทุนสนับสนุนการวิจัย นวัตกรรมและการสร้างสรรค์ คณะวิทยาศาสตร์');
$npdf->WriteHTML("
<br><br><br><br><b> $section9</b><br>
          $section9_1<br>
$section9_2
");

$npdf->SetXY(100,210);
$npdf->write(6.5,"$section8_12");
$npdf->SetXY(108,210);
$npdf->write(6.5,"..............................................................");
$npdf->SetXY(120,219);
$npdf->write(6.5,"$head_of_department");
$npdf->SetXY(105,220);
$npdf->write(6.5,"(....................................................................)");
$npdf->SetXY(98,230);
$npdf->write(6.5,"$section8_14");
$npdf->SetXY(125,229);
$npdf->write(6.5,"$department_name");
$npdf->SetXY(120,230);
$npdf->write(6.5,"..............................................................");

if(isset($_GET['save']) && $_GET['save']=='true'){
  $npdf->Output("./save_generate_pdf/proceeding_$id.pdf",'F');
  echo "
  <!DOCTYPE html>
  <html lang='en'>
  <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script src='https://printjs-4de6.kxcdn.com/print.min.js'></script>
  </head>
  <body>
    <script>
      printJS('./seniorproject/report/save_generate_pdf/proceeding_$id.pdf')
    </script>
  </body>
  </html>
  ";
}
else{
  $npdf->Output();
}

?>
