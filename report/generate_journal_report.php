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
            $this->Ln(5);
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
$sql = "select * from scholarship_journal where id=$id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc())  {
    $author=$row['author'];
    $department=$row['department'];
    $titleTH=$row['titleTH'];
    $titleEN=$row['titleEN'];
    $journal_name=$row['journal_name'];
    $volume=$row['volume'];
    $number=$row['number'];
    $page=$row['page'];
    $date=$row['date'];
    $type_of_document=$row['type_of_document'];
    $type_of_publication=$row['type_of_publication'];
    $database_name=$row['database_name'];
    $approval=$row['approval'];
    $participation=$row['participation'];
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
$journal_name=$npdf->conv($journal_name);
$volume=$npdf->conv($volume);
$page=$npdf->conv($page);
$number=$npdf->conv($number);
$date=$npdf->conv($date);
$type_of_document=$npdf->conv($type_of_document);
// $type_of_publication=$npdf->conv($type_of_publication);
$database_name=$npdf->conv($database_name);
// $approval=$npdf->conv($approval);
// $participation=$npdf->conv($participation);
$amount=$npdf->conv($amount);
$amount_text=$npdf->conv($amount_text);
$applicant=$npdf->conv($applicant);
$head_of_department=$npdf->conv($head_of_department);
$department_name=$npdf->conv($department_name);

$npdf->SetFont('THSarabunNew', '', '14');
$righttop=$npdf->conv('(แบบฟอร์มขอรับการสนับสนุนเงินรางวัลสำหรับผลงานที่ตีพิมพ์เผยแพร่ตั้งแต่วันที่ 1 ตุลาคม 2561)');
$npdf->SetXY(62,13);
$npdf->write(1,"$righttop");

$npdf->WriteHTML("<br>");
$npdf->SetFont('THSarabunNew', '', '17');
$header1=$npdf->conv('แบบฟอร์มขอรับการสนับสนุนเงินรางวัลสำหรับการเผยแพร่ผลงาน');
$header2=$npdf->conv('จากกองทุนสนับสนุนการวิจัย นวัตกรรมและการสร้างสรรค์ คณะวิทยาศาสตร์');
$header3=$npdf->conv('ประเภท ตีพิมพ์ในวารสารวิชาการ');

$npdf->WriteHTML("
<b><p align='center'>$header1</p></b>
<b><p align='center'>$header2</p></b>
<b><p align='center'>$header3</p></b>
");

$npdf->SetFont('THSarabunNew', '', '15');
$section1_1=$npdf->conv('ชื่อผู้ขอรับการสนับสนุน');
$section1_2=$npdf->conv("สังกัด");
$section1_3=$npdf->conv("ชื่อผลงานวิจัย");
$section1_4=$npdf->conv("ชื่อวารสารที่ตีพิมพ์");
$section1_5=$npdf->conv("ปีที่ ฉบับที่ เลขหน้า");
$section1_6=$npdf->conv("วัน เดือน ปี ที่ตีพิมพ์");

$npdf->SetXY(15,49);
$npdf->write(6.5,"$section1_1");
$npdf->SetXY(51,48);
$npdf->write(6.5,"$applicant");
$npdf->SetXY(50,49);
$npdf->write(6.5,"...........................................................................................");
$npdf->SetXY(129,49);
$npdf->write(6.5,"$section1_2");
$npdf->SetXY(139,48);
$npdf->write(6.5,"$department");
$npdf->SetXY(138,49);
$npdf->write(6.5,"..........................................................");
$npdf->SetXY(15,57);
$npdf->write(6.5,"$section1_3");
$npdf->SetXY(51,56);
$npdf->write(6.5,"$titleEN");
$npdf->SetXY(50,57);
$npdf->write(6.5,".................................................................................................................................................................");
$npdf->SetXY(51,63);
$npdf->write(6.5,"$titleTH");
$npdf->SetXY(50,64);
$npdf->write(6.5,".................................................................................................................................................................");
$npdf->SetXY(15,72);
$npdf->write(6.5,"$section1_4");
$npdf->SetXY(51,71);
$npdf->write(6.5,"$journal_name");
$npdf->SetXY(50,72);
$npdf->write(6.5,".................................................................................................................................................................");
$npdf->SetXY(15,80);
$npdf->write(6.5,"$section1_5");
$npdf->SetXY(51,79);
$npdf->write(6.5,"$volume, $number, $page");
$npdf->SetXY(50,80);
$npdf->write(6.5,".................................................................................");
$npdf->SetXY(120,80);
$npdf->write(6.5,"$section1_6");
$npdf->SetXY(150,79);
$npdf->write(6.5,"$date");
$npdf->SetXY(150,80);
$npdf->write(6.5,".............................................");


$section2=$npdf->conv('ประเภทของผลงาน');
$npdf->WriteHTML("<br><br><b>    $section2</b>");
//1
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,97);
if($type_of_document=="research_article"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(17,97);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,97);
$npdf->write(6.5,"Research Article");
//2
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(65,97);
if($type_of_document=="review_article"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(65,97);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(70,97);
$npdf->write(6.5,"Review Article");
//3
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(105,97);
if($type_of_document=="book"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(105,97);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(110,97);
$npdf->write(6.5,"Book");
//4
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(135,97);
if($type_of_document=="book_chapter"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(135,97);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(140,97);
$npdf->write(6.5,"Book Chapter");

$section3=$npdf->conv('ประเภทของวารสารที่ตีพิมพ์');
$section3_1=$npdf->conv('(เลือกเพียง 1 ประเภท)');
$section3_2=$npdf->conv('วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูล ISI/Scopus รางวัลละไม่เกิน 30,000 บาท');
$section3_3=$npdf->conv('วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูลตามเกณฑ์ ก.พ.อ. รางวัลละไม่เกิน 10,000 บาท');
$section3_4=$npdf->conv('โปรดระบุชื่อฐานข้อมูล');
$section3_5=$npdf->conv('วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 1 รางวัลละไม่เกิน 6,000 บาท');
$section3_6=$npdf->conv('วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 2 รางวัลละไม่เกิน 4,000 บาท');
$npdf->WriteHTML("<br><br><b>    $section3</b> $section3_1");
//1
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(14,114);
if($type_of_publication=="วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูล ISI/Scopus รางวัลละไม่เกิน 30,000 บาท"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(14,114);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(19,114);
$npdf->write(6.5,"$section3_2");
//2
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(14,121);
if($type_of_publication=="วารสารระดับนานาชาติที่ปรากฏในฐานข้อมูลตามเกณฑ์ ก.พ.อ. รางวัลละไม่เกิน 10,000 บาท"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(14,121);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(19,121);
$npdf->write(6.5,"$section3_3");
$npdf->SetXY(19,128);
$npdf->write(6.5,"$section3_4");
$npdf->SetXY(52,127);
$npdf->write(6.5,"$database_name");
$npdf->SetXY(50,128);
$npdf->write(6.5,".............................");
//3
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(14,135);
if($type_of_publication=="วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 1 รางวัลละไม่เกิน 6,000 บาท"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(14,135);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(19,135);
$npdf->write(6.5,"$section3_5");
//4
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(14,142);
if($type_of_publication=="วารสารระดับชาติที่ปรากฏในฐานข้อมูล TCI กลุ่ม 2 รางวัลละไม่เกิน 4,000 บาท"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(14,142);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(19,142);
$npdf->write(6.5,"$section3_6");

$section4=$npdf->conv('การเป็นผลงานที่ใช้ขออนุมัติสิ้นสุดสัญญาโครงการที่ได้รับทุนอุดหนุนการวิจัยจากคณะวิทยาศาสตร์');
$section4_1=$npdf->conv('กรณีที่ 1');
$section4_2=$npdf->conv(' ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)');
$section4_3=$npdf->conv('กรณีที่ 2');
$section4_4=$npdf->conv(' เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)');
$npdf->WriteHTML("<br><br><b>    $section4</b>");
//1
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(35,159);
if($approval=="กรณีที่ 1 ไม่เป็น (ได้รับการสนับสนุนเต็มจำนวน)"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(35,159);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(20,159);
$npdf->write(6.5,"$section4_1");
$npdf->SetXY(40,159);
$npdf->write(6.5,"$section4_2");
//2
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(35,166);
if($approval=="กรณีที่ 2 เป็น (ได้รับการสนับสนุน 20% ของเงินรางวัลที่กำหนด)"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(35,166);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(20,166);
$npdf->write(6.5,"$section4_3");
$npdf->SetXY(40,166);
$npdf->write(6.5,"$section4_4");

$section5=$npdf->conv('การมีส่วนร่วมในผลงาน');
$section5_1=$npdf->conv('กรณีที่ 1');
$section5_2=$npdf->conv('First Author หรือ');
$section5_3=$npdf->conv(' Corresponding Author (ได้รับการสนับสนุนเต็มจำนวน)');
$section5_4=$npdf->conv('กรณีที่ 2');
$section5_5=$npdf->conv(' เป็นผู้ร่วมเขียน (ได้รับการสนับสนุนกึ่งหนึ่งของเงินรางวัลที่ได้รับจากหัวข้อก่อนหน้า)');
$npdf->WriteHTML("<br><br><b>    $section5</b>");
//1
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(35,182);
if($participation=="กรณีที่ 1 First Author"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(35,182);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(20,182);
$npdf->write(6.5,"$section5_1");
$npdf->SetXY(40,182);
$npdf->write(6.5,"$section5_2");
//2
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(68,182);
if($participation=="กรณีที่ 1 Corresponding Author"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(68,182);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(73,182);
$npdf->write(6.5,"$section5_3");
//3
$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(35,189);
if($participation=="กรณีที่ 2 เป็นผู้ร่วมเขียน"){
  $npdf->write(6.5,'3');
}
$npdf->SetXY(35,189);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(20,189);
$npdf->write(6.5,"$section5_4");
$npdf->SetXY(39,189);
$npdf->write(6.5,"$section5_5");
$npdf->SetXY(63,189);
$npdf->write(6.5,"_________________________________________________");

$section7=$npdf->conv('เอกสารแนบ');
$section7_1=$npdf->conv('(ต้องมีทุกรายการ)');
$section7_2=$npdf->conv('ในกรณี');
$section7_3=$npdf->conv('ที่มี');
$section7_4=$npdf->conv('สำเนาผลงานวิจัยฉบับที่ตีพิมพ์เป็นดิจิตอลไฟล์');
$section7_5=$npdf->conv('- ส่งไฟล์งานวิจัยมายัง scisilpakorn@gmail.com');
$section7_6=$npdf->conv('- สำเนาหน้าแรกของผลงานและหน้าที่ปรากฏชื่อผู้เขียน');
$section7_7=$npdf->conv('- หลักฐานการปรากฏในฐานข้อมูลตามที่ระบุ');
$section7_8=$npdf->conv('ในกรณี');
$section7_9=$npdf->conv('ที่ไม่มี');
$section7_10=$npdf->conv('สำเนาผลงานวิจัยเป็นดิจิตอลไฟล์');
$section7_11=$npdf->conv('- สำเนาผลงานที่ตีพิมพ์ทั้งฉบับ');
$section7_12=$npdf->conv('- หลักฐานการปรากฏในฐานข้อมูลตามที่ระบุ');
$npdf->WriteHTML("<br><br><b>    $section7</b> $section7_1<br><br>
        $section7_2<b><u>$section7_3</u></b>$section7_4<br><br>
        $section7_5<br><br>
        $section7_6<br><br>
        $section7_7<br><br>
        $section7_8<b><u>$section7_9</u></b>$section7_10<br><br>
        $section7_11<br><br>
        $section7_12<br>
");

$section8=$npdf->conv('การรับรองผลงาน');
$section8_1=$npdf->conv('ข้าพเจ้าขอรับรองว่า ผลงานเรื่องดังกล่าวข้างต้น เป็นไปตามหลักเกณฑ์ เงื่อนไข');
$section8_2=$npdf->conv('และวิธีการสนับสนุนเงินรางวัลหรือเงินสมนาคุณจากกองทุนสนับสนุนการวิจัย นวัตกรรมและการสร้างสรรค์');
$section8_3=$npdf->conv('คณะวิทยาศาสตร์ ดังนี้');
$section8_4=$npdf->conv('เป็นผลงานที่เกิดขึ้นในระหว่างที่ผู้ขอรับการสนับสนุนปฏิบัติงานที่คณะวิทยาศาสตร์ มหาวิทยาลัยศิลปากร และ');
$section8_5=$npdf->conv('ไม่เป็นส่วนหนึ่งของวิทยานิพนธ์เพื่อสำเร็จการศึกษาในระดับใด ๆ ของผู้ขอรับการสนับสนุน');
$section8_6=$npdf->conv('ที่อยู่ของผู้ขอรับการสนับสนุนในผลงานปรากฏชื่อ คณะวิทยาศาสตร์ มหาวิทยาลัยศิลปากร เป็นอย่างน้อย');
$section8_7=$npdf->conv('เป็นผลงานที่ตีพิมพ์ในวารสารที่มี peer-review');
$section8_8=$npdf->conv('ณ วันที่ส่งผลงานเพื่อตีพิมพ์ (Submitted) วารสารดังกล่าวหรือสำนักพิมพ์เจ้าของวารสารไม่ปรากฏอยู่ใน');
$section8_9=$npdf->conv('Beall`s List');
$section8_10=$npdf->conv('ผลงานเรื่องดังกล่าวตีพิมพ์เผยแพร่มาแล้วเป็นระยะเวลาไม่เกิน 1 ปี นับถึงวันที่ยื่นขอรับการสนับสนุน');
$section8_11=$npdf->conv('และไม่เคยได้รับการสนับสนุนเงินรางวัลหรือเงินสมนาคุณประเภทใด ๆ จากคณะวิทยาศาสตร์');
$section8_12=$npdf->conv('มหาวิทยาลัยศิลปากร');
$section8_13=$npdf->conv('ข้าพเจ้าขอรับการสนับสนุนเงินรางวัลการเผยแพร่ผลงานดังกล่าว จากกองทุนสนับสนุนการวิจัย');
$section8_14=$npdf->conv('นวัตกรรมและการสร้างสรรค์ คณะวิทยาศาสตร์ เป็นจำนวนเงิน');
$section8_15=$npdf->conv('บาท');
$section8_16=$npdf->conv('ลงชื่อ ');
$section8_17=$npdf->conv('ผู้ขอรับการสนับสนุน');
$section8_18=$npdf->conv('หัวหน้าภาควิชา');

$npdf->WriteHTML("<br><b>    $section8</b><br>");

$npdf->SetXY(26,22);
$npdf->write(6.5,"$section8_1");
$npdf->SetXY(15,29);
$npdf->write(6.5,"$section8_2");
$npdf->SetXY(15,36);
$npdf->write(6.5,"$section8_3");

$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,43);
$npdf->write(6.5,'3');
$npdf->SetXY(17,43);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,43);
$npdf->write(6.5,"$section8_4");
$npdf->SetXY(22,50);
$npdf->write(6.5,"$section8_5");

$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,57);
$npdf->write(6.5,'3');
$npdf->SetXY(17,57);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,57);
$npdf->write(6.5,"$section8_6");

$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,64);
$npdf->write(6.5,'3');
$npdf->SetXY(17,64);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,64);
$npdf->write(6.5,"$section8_7");

$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,71);
$npdf->write(6.5,'3');
$npdf->SetXY(17,71);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,71);
$npdf->write(6.5,"$section8_8");
$npdf->SetXY(22,78);
$npdf->write(6.5,"$section8_9");

$npdf->SetFont('ZapfDingbats','', 13);
$npdf->SetXY(17,85);
$npdf->write(6.5,'3');
$npdf->SetXY(17,85);
$npdf->write(6.5,'q');
$npdf->SetFont('THSarabunNew', '', '15');
$npdf->SetXY(22,85);
$npdf->write(6.5,"$section8_10");
$npdf->SetXY(22,92);
$npdf->write(6.5,"$section8_11");
$npdf->SetXY(22,99);
$npdf->write(6.5,"$section8_12");

$npdf->SetXY(24,115);
$npdf->write(6.5,"$section8_13");
$npdf->SetXY(15,122);
$npdf->write(6.5,"$section8_14");
$npdf->SetXY(115,121);
$npdf->write(6.5,"$amount");
$npdf->SetXY(102,122);
$npdf->write(6.5,"...........................................");
$npdf->SetXY(140,122);
$npdf->write(6.5,"$section8_15");
$npdf->SetXY(30,128);
$npdf->write(6.5,"$amount_text");
$npdf->SetXY(15,129);
$npdf->write(6.5,"(......................................................................)");
$npdf->SetXY(120,150);
$npdf->write(6.5,"$section8_16");
$npdf->SetXY(128,150);
$npdf->write(6.5,".............................................................");
$npdf->SetXY(138,156);
$npdf->write(6.5,"$applicant");
$npdf->SetXY(127,157);
$npdf->write(6.5,"(.............................................................)");
$npdf->SetXY(138,164);
$npdf->write(6.5,"$section8_17");

$section9=$npdf->conv('คำรับรองจากหัวหน้าภาควิชา/หัวหน้างาน');
$section9_1=$npdf->conv('ข้าพเจ้าขอรับรองว่าข้อความดังกล่าวข้างต้นเป็นจริงทุกประการ');
$section9_2=$npdf->conv('และผลงานดังกล่าวสมควรได้รับการสนับสนุนเงินรางวัลการเผยแพร่ผลงานจากกองทุนสนับสนุนการวิจัย');
$section9_3=$npdf->conv('นวัตกรรมและการสร้างสรรค์ คณะวิทยาศาสตร์');
$section9_4=$npdf->conv('ลงชื่อ');
$section9_5=$npdf->conv('หัวหน้าภาควิชา');
$npdf->WriteHTML("<br><br><br><br><b>    $section9</b><br>");

$npdf->SetXY(25,190);
$npdf->write(6.5,"$section9_1");
$npdf->SetXY(15,197);
$npdf->write(6.5,"$section9_2");
$npdf->SetXY(15,204);
$npdf->write(6.5,"$section9_3");
$npdf->SetXY(120,230);
$npdf->write(6.5,"$section9_4");
$npdf->SetXY(128,230);
$npdf->write(6.5,".............................................................");
$npdf->SetXY(138,236);
$npdf->write(6.5,"$head_of_department");
$npdf->SetXY(127,237);
$npdf->write(6.5,"(.............................................................)");
$npdf->SetXY(125,244);
$npdf->write(6.5,"$section9_5");
$npdf->SetXY(147,244);
$npdf->write(6.5,"........................................");
$npdf->SetXY(150,243);
$npdf->write(6.5,"$department_name");

if(isset($_GET['save']) && $_GET['save']=='true'){
  $npdf->Output("./save_generate_pdf/journal_$id.pdf",'F');
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
      printJS('./seniorproject/report/save_generate_pdf/journal_$id.pdf')
    </script>
  </body>
  </html>
  ";
}
else{
  $npdf->Output();
}

?>
