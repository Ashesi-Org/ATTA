<?php
// Start session
session_start();

// For header redirection
ob_start();

// Function to check if user is logged in
function logged_in()
{
    if (!empty($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

// Function to check if user is an admin
function is_admin()
{
    if (get_user_role($_SESSION['user_id']) == 2) {
        return true;
    } else {
        return false;
    }
}

// function to check if the learnng style is set
function is_learning_style_set($user_id)
{
    if (!empty(get_user_learning_style1($user_id))) {
        return true;
    } else {
        return false;
    }
}



require __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;

function generateImageContent($subsections)
{
    // Get the first subtopic content
    $content = get_subsection_content_slides($subsections[0]['subtopic_id']);

    // Use delimiters to separate content into ppt slides (the delimiters are '###')
    $slides = explode('###', $content);

    // Create instance of FPDF class
    $pdf = new PDF();
    $pdf->SetFont('Arial', '', 16);

    // Add each slide to a new landscape page
    foreach ($slides as $slide) {
        $pdf->AddPage('L'); // 'L' denotes landscape orientation
        $pdf->SetY(($pdf->GetPageHeight() - 10) / 2); // Center text vertically
        $pdf->SetX(0); // Center text horizontally
        $pdf->MultiCell(0, 10, $slide, 0, 'C'); // Center text
    }

    // Get the PDF content
    $pdfContent = $pdf->Output('', 'S');

    // Encode the PDF content in base64
    $imageBase64 = base64_encode($pdfContent);

    return $imageBase64;
}
