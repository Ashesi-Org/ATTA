<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include core file
include_once('../Settings/core.php');

// Include the general function
include_once('../Functions/general_function.php');

// Include PHPPresentation
require '../vendor/autoload.php';

// Get form data
$section_id = $_POST['sectionId'];
$section_content = $_POST['content'];
$user_id = $_POST['user_id'];
$status = $_POST['status'];

// Set message session variable
$_SESSION['content'] = $section_content;

// Generate PDF with the updated content
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Add a custom header if needed
    }

    function Footer()
    {
        // Add a custom footer if needed
    }
}

// update the topic status
$section_status = update_section_status($section_id, $status);
if (!$section_status) {
    echo "Failed to update section status";
    exit();
}

try {
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 16);
    $message = $_SESSION['content'];
    $pdf->MultiCell(0, 10, $message);

    // Get the PDF content
    $pdfContent = $pdf->Output('', 'S');

    // Encode the PDF content in base64
    $pdfBase64 = base64_encode($pdfContent);

    

    echo $pdfBase64;
} catch (Exception $e) {
    
    echo  $e->getMessage();
}
?>
