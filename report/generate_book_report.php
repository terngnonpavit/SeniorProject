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
$npdf=new PDF_HTML();
$npdf->AddPage();
$npdf->SetThaiFont();
$npdf->SetFont('THSarabunNew', '', '15');
$year=$npdf->conv($_POST['year']);
$titleTH=$npdf->conv($_POST['titleTH']);
$titleEN=$npdf->conv($_POST['titleEN']);
$writer_name=$npdf->conv($_POST['writer_name']);
$writer_department=$npdf->conv($_POST['writer_department']);
$write_ratio=$npdf->conv($_POST['write_ratio']);
$co_writer_name=$npdf->conv($_POST['co_writer_name']);
$co_writer_department=$npdf->conv($_POST['co_writer_department']);
$co_write_ratio=$npdf->conv($_POST['co_write_ratio']);
$keywordTH=$npdf->conv($_POST['keywordTH']);
$keywordEN=$npdf->conv($_POST['keywordEN']);
$amount=$npdf->conv($_POST['amount']);
$amount_text=$npdf->conv($_POST['amount_text']);
$subject_no=$npdf->conv($_POST['subject_no']);
$subject=$npdf->conv($_POST['subject']);
$for_student=$npdf->conv($_POST['for_student']);
$student_year=$npdf->conv($_POST['student_year']);
$page_amount=$npdf->conv($_POST['page_amount']);
$chapter_no_1=$npdf->conv($_POST['chapter_no']);
$chapter_no_2=$npdf->conv($_POST['chapter_no']);
$chapter_no_3=$npdf->conv($_POST['chapter_no']);
$chapter_name_1=$npdf->conv($_POST['chapter_name']);
$chapter_name_2=$npdf->conv($_POST['chapter_name']);
$chapter_name_3=$npdf->conv($_POST['chapter_name']);
$content_1=$npdf->conv($_POST['content']);
$content_2=$npdf->conv($_POST['content']);
$content_3=$npdf->conv($_POST['content']);
$teaching_history=$npdf->conv($_POST['teaching_history']);
$applicant=$npdf->conv($_POST['applicant']);
$headofdepartment=$npdf->conv($_POST['head_of_department']);
$department_name=$npdf->conv($_POST['department_name']);

$header=$npdf->conv('ข้อเสนอโครงการ');
$header2=$npdf->conv('ทุนสนับสนุนการเขียนตำราจากกองทุนสนับสนุนการวิจัย');
$header3=$npdf->conv('นวัตกรรมและการสร้างสรรค์ คณะวิทยาศาสตร์');
$header4=$npdf->conv("ประจำปีงบประมาณ ");

$section1=$npdf->conv('1. ชื่อตำรา');
$section1_1=$npdf->conv("    (ไทย)");
$section1_2=$npdf->conv("    (English)");

$section2=$npdf->conv('2. ชื่อผู้เขียน หรือคณะผู้เขียน');
$section2_1=$npdf->conv('    หัวหน้าโครงการ          ชื่อ-สกุล');
$section2_2=$npdf->conv('                                 ภาควิชา');
$section2_3=$npdf->conv('                                 สัดส่วนของการเขียนตำรา');
$section2_4=$npdf->conv('เปอร์เซ็นต์');
$section2_5=$npdf->conv('    ผู้ร่วมโครงการ            ชื่อ-สกุล');
$section2_6=$npdf->conv('                                 ภาควิชา');
$section2_7=$npdf->conv('                                 สัดส่วนของการเขียนตำรา');
$section2_8=$npdf->conv('เปอร์เซ็นต์');

$section3=$npdf->conv('3. คำสำคัญ');
$section3_1=$npdf->conv("    (ไทย)");
$section3_2=$npdf->conv("    (English)");

$section4=$npdf->conv('4. จำนวนเงินทุนที่ขอรับการสนับสนุน');

$npdf->WriteHTML("
<br>
<b><p align='center'>$header</p></b>
<b><p align='center'>$header2</p></b>
<b><p align='center'>$header3</p></b>
<b><p align='center'>$header4..........$year..........</p></b>
<br>
<b>$section1</b><br>
$section1_1................$titleTH....................................................................................................................................................<br>
    ...........................................................................................................................................................................................................<br>
$section1_2................$titleEN....................................................................................................................................................<br>
    ...........................................................................................................................................................................................................<br>
<br>
<b>$section2</b><br>
$section2_1................$writer_name..............................................................................................................<br>
$section2_2................$writer_department..................................................................................................................<br>
$section2_3.....$write_ratio.....$section2_4<br>
$section2_5................$co_writer_name..............................................................................................................<br>
$section2_6................$co_writer_department..................................................................................................................<br>
$section2_7.....$co_write_ratio.....$section2_8<br>
<br>
<b>$section3</b><br>
$section3_1.............................$keywordTH....................................................................................................................................................<br>
$section3_2.......................$keywordEN....................................................................................................................................................<br>
<br>
<b>$section4</b><br>
");

$section4_1=$npdf->conv('   จำนวน');
$section4_2=$npdf->conv('บาท');
$section4_3=$npdf->conv('(');
$section4_4=$npdf->conv('บาทถ้วน)');

$npdf->SetTextColor(0,0,0);
$npdf->WriteHTML("
$section4_1.......$amount.......$section4_2
$section4_3.......$amount_text.......$section4_4<br>
");

$section4_5=$npdf->conv('   * จำนวนเงินทุนพิจารณาสนับสนุนทางด้านวิชาการและสนับสนุนด้านการพิมพ์เอกสาร ดังนี้');
$section4_6=$npdf->conv('    ส่วนที่ 1 ด้านวิชาการ');
$section4_7=$npdf->conv('            -    ตำราประกอบการสอนรายวิชาชั้นปีที่ 1 และ 2         สนับสนุนเงินทุน 20,000 บาท');
$section4_8=$npdf->conv('            -    ตำราประกอบการสอนรายวิชาชั้นปีที่ 3 และ 4         สนับสนุนเงินทุน 30,000 บาท');
$section4_9=$npdf->conv('            -    ตำราประกอบการสอนรายวิชาระดับบัณฑิตศึกษา      สนับสนุนเงินทุน 40,000 บาท');
$section4_10=$npdf->conv('    ส่วนที่ 2 ด้านการพิมพ์เอกสาร');
$section4_11=$npdf->conv('           คำนวณจากปริมาณเนื้อหา (จำนวนหน้า) หน้าละ 100 บาท');
$section4_12=$npdf->conv('    โดยข้อเสนอโครงการเขียนตำราทุกโครงการจะได้รับการจัดสรรเงินทุนสนับสนุนการเขียนตำราทั้ง 2 ส่วน แต่รวมแล้ว');
$section4_13=$npdf->conv('    ต้องไม่เกิน 50,000 บาท');
$section4_14=$npdf->conv('    * ในกรณีที่เป็นตำราในรายวิชาปฏิบัติการให้การสนับสนัุนเป็นกึ่งหนึ่งตามหลักเกณฑ์ข้างต้น');

$npdf->SetTextColor(255,0,0);
$npdf->WriteHTML("
$section4_5<br>
<b>$section4_6</b><br>
$section4_7<br>
$section4_8<br>
$section4_9<br>
<b>$section4_10</b><br>
$section4_11<br>
$section4_12<br>
$section4_13<br>
$section4_14<br>
<br>
");

$section5=$npdf->conv('5. ใช้ประกอบการสอน');
$section5_1=$npdf->conv('     รายวิชา');
$section5_2=$npdf->conv('ชื่อวิชา');
$section5_3=$npdf->conv('สำหรับนักศึกษาระดับ');
$section5_4=$npdf->conv('ชั้นปีที่');
$section6=$npdf->conv('6. ปริมาณเนื้อหาและเนื้อหาโดยสังเขป');
$section6_1=$npdf->conv('    ปริมาณเนื้อหา (จำนวนหน้า) โดยประมาณ จำนวน');
$section6_2=$npdf->conv('หน้า โดยประกอบด้วยเนื้อหาโดยสังเขป ดังนี้');
$section6_3=$npdf->conv('    บทที่');
$section6_4=$npdf->conv('ชื่อบท');

$npdf->SetTextColor(0,0,0);
$npdf->WriteHTML("
<b>$section5</b><br>
$section5_1.......$subject_no.......$section5_2.......$subject.......$section5_3.......$for_student.......$section5_4 $student_year<br>
<br>
<br>
<br>
<b>$section6</b><br>
$section6_1.......$page_amount.......$section6_2<br>
$section6_3.......$chapter_no1.......$section6_4.......$chapter_name1..............................................................................................................................<br>
");

$section6_5=$npdf->conv('          *เนื้อหา ');
$npdf->SetTextColor(255,0,0);
$npdf->WriteHTML("
$section6_5................................................................................................................................................................................<br>
.............................................................................................................................................................................................................<br>
.............................................................................................................................................................................................................<br>
");

$section7=$npdf->conv('7. ประวัติการสอน');
$section7_1=$npdf->conv('(โดยสังเขป)');
$npdf->SetTextColor(0,0,0);
$npdf->WriteHTML("
<br><b>$section7</b>
$section7_1<br>
");

$section7_2=$npdf->conv('  *หากมีอยู่แล้วสามารถแนบประวัติการสอนต่อท้ายข้อเสนอโครงการได้');
$npdf->SetTextColor(255,0,0);
$npdf->WriteHTML("
$section7_2<br>
................................................................................................................................................................................................................<br>
................................................................................................................................................................................................................<br>
................................................................................................................................................................................................................<br>
");

$section8=$npdf->conv('                                                                                                                 ลงชื่อ');
$section8_1=$npdf->conv('                                                                                                               (...................................)');
$section8_2=$npdf->conv('                                                                                                                       ผู้ขอรับทุน');
$npdf->SetTextColor(0,0,0);
$npdf->WriteHTML("
<br><br><br><br><br>$section8 $applicant<br>
$section8_1<br>
$section8_2<br>
");

$section9=$npdf->conv('                                                                                                                 ลงชื่อ');
$section9_1=$npdf->conv('                                                                                                               (...................................)');
$section9_2=$npdf->conv('                                                                                                                  หัวหน้าภาควิชา');
$npdf->SetTextColor(0,0,0);
$npdf->WriteHTML("
<br><br><br><br><br>$section9 $headofdepartment<br>
$section9_1<br>
$section9_2 $department_name<br>
");


$npdf->Output();

?>
