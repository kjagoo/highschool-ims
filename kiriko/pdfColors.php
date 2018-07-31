<?php
/*
    Author     : Fernando Herrero
    Mail       : fherrero[at]noticiasdenavarra.com
    Program    : pdf-cmyk.php
    License    : GPL v2
    Description: Allow to use CMYK color space:
                 SetDrawColor() => Set draw color to black
                 SetDrawColor(int gray) => value in % (0 = black, 100 = white)
                 SetDrawColor(int red, int green, int blue) => 0 to 255
                 SetDrawColor(int cyan, int magenta, int yellow, int black) => values in % (0 to 100)
                 SetFillColor and SetTextColor same as SetDrawColor
    Date       : 2004-01-22
*/
require('fpdf.php');

class cmykPDF extends FPDF {

    function SetDrawColor() {
        //Set color for all stroking operations
        switch(func_num_args()) {
            case 1:
                $g = func_get_arg(0);
                $this->DrawColor = sprintf('%.3f G', $g / 100);
                break;
            case 3:
                $r = func_get_arg(0);
                $g = func_get_arg(1);
                $b = func_get_arg(2);
                $this->DrawColor = sprintf('%.3f %.3f %.3f RG', $r / 255, $g / 255, $b / 255);
                break;
            case 4:
                $c = func_get_arg(0);
                $m = func_get_arg(1);
                $y = func_get_arg(2);
                $k = func_get_arg(3);
                $this->DrawColor = sprintf('%.3f %.3f %.3f %.3f K', $c / 100, $m / 100, $y / 100, $k / 100);
                break;
            default:
                $this->DrawColor = '0 G';
        }
        if($this->page > 0)
            $this->_out($this->DrawColor);
    }

    function SetFillColor() {
        //Set color for all filling operations
        switch(func_num_args()) {
            case 1:
                $g = func_get_arg(0);
                $this->FillColor = sprintf('%.3f g', $g / 100);
                break;
            case 3:
                $r = func_get_arg(0);
                $g = func_get_arg(1);
                $b = func_get_arg(2);
                $this->FillColor = sprintf('%.3f %.3f %.3f rg', $r / 255, $g / 255, $b / 255);
                break;
            case 4:
                $c = func_get_arg(0);
                $m = func_get_arg(1);
                $y = func_get_arg(2);
                $k = func_get_arg(3);
                $this->FillColor = sprintf('%.3f %.3f %.3f %.3f k', $c / 100, $m / 100, $y / 100, $k / 100);
                break;
            default:
                $this->FillColor = '0 g';
        }
        $this->ColorFlag = ($this->FillColor != $this->TextColor);
        if($this->page > 0)
            $this->_out($this->FillColor);
    }

    function SetTextColor() {
        //Set color for text
        switch(func_num_args()) {
            case 1:
                $g = func_get_arg(0);
                $this->TextColor = sprintf('%.3f g', $g / 100);
                break;
            case 3:
                $r = func_get_arg(0);
                $g = func_get_arg(1);
                $b = func_get_arg(2);
                $this->TextColor = sprintf('%.3f %.3f %.3f rg', $r / 255, $g / 255, $b / 255);
                break;
            case 4:
                $c = func_get_arg(0);
                $m = func_get_arg(1);
                $y = func_get_arg(2);
                $k = func_get_arg(3);
                $this->TextColor = sprintf('%.3f %.3f %.3f %.3f k', $c / 100, $m / 100, $y / 100, $k / 100);
                break;
            default:
                $this->TextColor = '0 g';
        }
        $this->ColorFlag = ($this->FillColor != $this->TextColor);
    }
    
    
var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data,$x,$y)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
 
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        
        //Print the text
        $this->SetXY($x,$y);
        $this ->SetFont('msmincho', '', 12);
        $this->MultiCell($w,6,$data[$i],0,"J");
        //Put the position to the right of the cell
       
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}




    
}
?> 