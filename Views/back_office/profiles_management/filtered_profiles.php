<?php

require_once __DIR__ . '/../../../Controls/profileController.php';

// Check if the filter option is provided
if (isset($_GET['filterCheck'])) {
    $filterCheck = $_GET['filterCheck'];



    // Initialize the profile controller
    $profileController = new ProfileC();

    // List filtered profiles based on the filter option
    $filteredProfiles = $profileController->listProfileFilter($filterCheck);

    // Output the filtered profiles as table rows
    foreach ($filteredProfiles as $profile) {
        echo '<tr>';
        echo '<td>
            <button type="button" style="font-size: medium;" class="btn btn-primary btn-sm me-2" onclick="window.location.href=\'./updateProfile.php?profile_id=' . $profile['profile_id'] . '\'"><a class="ti ti-edit text-white"></a></button>
            <button type="button" style="font-size: medium;" class="btn btn-danger btn-sm" onclick="window.location.href=\'./deleteProfile.php?profile_id=' . $profile['profile_id'] . '\'"><a class="ti ti-x text-white"></a></button>
          </td>';
        echo '<td>' . (isset($profile['profile_id']) ? $profile['profile_id'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_first_name']) ? $profile['profile_first_name'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_family_name']) ? $profile['profile_family_name'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_userid']) ? $profile['profile_userid'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_phone_number']) ? $profile['profile_phone_number'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_bday']) ? $profile['profile_bday'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_gender']) ? $profile['profile_gender'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_region']) ? $profile['profile_region'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_city']) ? $profile['profile_city'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_bio']) ? $profile['profile_bio'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_current_position']) ? $profile['profile_current_position'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_education']) ? $profile['profile_education'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_subscription']) ? $profile['profile_subscription'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_auth']) ? $profile['profile_auth'] : '') . '</td>';
        echo '<td>' . (isset($profile['profile_acc_verif']) ? $profile['profile_acc_verif'] : '') . '</td>';
        echo '</tr>';
    }
}
?>
