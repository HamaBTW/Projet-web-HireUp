<?php

require_once __DIR__ . '/../../../Controls/job_management/JobC.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add new job

    $title = $_POST["job_title"];
    $company = $_POST["company"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $salary = $_POST["salary"];
    $category = $_POST["category"];

    // Include the controller file
    $jobController = new JobController();
    $job_id = $jobController->generateJobId(7);

    if (!empty($_FILES['job_image']['name'])) {

        // Get profile photo and cover data
        $job_image_tmp_name = $_FILES['job_image']['tmp_name'];
        $job_image = file_get_contents($job_image_tmp_name);

        // Only echo the result if the job update is successful
        $result = $jobController->createJob($job_id, $title, $company, $location, $description, $salary, $category, $job_image);

        if ($result !== false) {
            // Redirect to prevent form resubmission
            header("Location: ./jobs.php?creation-image=true");
            exit;
        }
    } else {
        // Get profile photo and cover data
        $job_image = null;
        // Only echo the result if the job update is successful
        $result = $jobController->createJob($job_id, $title, $company, $location, $description, $salary, $category, $job_image);

        if ($result !== false) {
            // Redirect to prevent form resubmission

            header("Location: ./jobs.php?creation-job=true");
            exit;
        }
    }
}
