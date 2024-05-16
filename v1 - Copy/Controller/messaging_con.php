<?php

require_once __DIR__ . '/../config.php';
include_once __DIR__ . '/user_con.php';
require_once __DIR__ . '/profileController.php';
require_once __DIR__ . '/user_con.php';

class MessagingCon {

    private $tab_name;

    public function __construct($tab_name){
        $this->tab_name = $tab_name;
    }

    public function generateId($id_length){
        $numbers = '0123456789';
        $numbers_length = strlen($numbers);
        $random_id = '';

        // Generate random ID
        for ($i = 0; $i < $id_length; $i++) {
            $random_id .= $numbers[rand(0, $numbers_length - 1)];
        }

        return (string) $random_id; // Ensure the return value is a string
    }

    function extractTimeFromString($datetimeString) {
        $timestamp = strtotime($datetimeString);
        $time = date("H:i", $timestamp);
        return $time;
    }

    public function sendMessage($message) {
        $sql = "INSERT INTO $this->tab_name(id, sender_id, receiver_id, message_content) VALUES (:id, :sender_id, :receiver_id, :message_content)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(
               [
                'id' => $message->get_id(), 
                'sender_id' => $message->get_sender_id(), 
                'receiver_id' => $message->get_receiver_id(), 
                'message_content' => $message->get_message_content()
                ]
            );
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getTwoUsersMessages($user1, $user2) {
        $sql = "SELECT * FROM $this->tab_name WHERE (sender_id = :user1 AND receiver_id = :user2) OR (sender_id = :user2 AND receiver_id = :user1) ORDER BY date_time";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user1' => $user1,
                'user2' => $user2
            ]);
            
            // Fetch all rows from the result set as an associative array
            $messages = $query->fetchAll(PDO::FETCH_ASSOC);
            
            return $messages;
        } catch (PDOException $e) {
            // Handle any errors that might occur
            echo "Error: " . $e->getMessage();
        }
    }

    public function getLastTwoUsersMessage($my_profile_id, $other_profile_id) {
        $sql = "SELECT * FROM $this->tab_name 
                WHERE (sender_id = :user1 AND receiver_id = :user2) 
                OR (sender_id = :user2 AND receiver_id = :user1) 
                ORDER BY date_time DESC 
                LIMIT 1"; // Limit to one row, sorted by date_time in descending order
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user1' => $my_profile_id,
                'user2' => $other_profile_id
            ]);
            
            // Fetch the last row from the result set as an associative array
            $message = $query->fetch(PDO::FETCH_ASSOC);
            
            return $message;
        } catch (PDOException $e) {
            // Handle any errors that might occur
            echo "Error: " . $e->getMessage();
        }
    }

    function groupMessagesBySender($messages) {
        $packs = []; // List to store packs
        
        $currentPack = []; // Initialize current pack
        
        foreach ($messages as $index => $message) {
            // If it's the first message or sender ID has changed
            if ($index === 0 || $message['sender_id'] !== $messages[$index - 1]['sender_id']) {
                // Add current pack to packs list if it's not empty
                if (!empty($currentPack)) {
                    $packs[] = $currentPack;
                }
                // Start a new pack
                $currentPack = [];
            }
            
            // Add message to current pack
            $currentPack[] = $message;
        }
        
        // Add the last pack to packs list if it's not empty
        if (!empty($currentPack)) {
            $packs[] = $currentPack;
        }
        
        return $packs;
    }

    //experemental function
    function printGroupedMessages($groupedMessages) {
        foreach ($groupedMessages as $packIndex => $pack) {
            echo "Pack " . ($packIndex + 1) . ":\n";
            foreach ($pack as $messageIndex => $message) {
                echo "Message " . ($messageIndex + 1) . ":\n";
                echo "Sender ID: " . $message['sender_id'] . "\n";
                echo "Receiver ID: " . $message['receiver_id'] . "\n";
                echo "Content: " . $message['message_content'] . "\n";
                echo "Time: " . $message['date_time'] . "\n";
                echo "\n";
            }
            echo "\n";
        }
    }
      
       
    function generateMessageMeHTML($id, $msgs, $time) {
        $profileController = new ProfileC();

        $profile = $profileController->getProfileById($id);
    
        // Initialize an empty string to store the HTML
        $html = '<li class="conversation-item me">
                    <div class="conversation-item-side">
                        <img class="conversation-item-image" src="data:image/jpeg;base64,' . base64_encode($profile['profile_photo']) . '" alt="">
                    </div>
                    <div class="conversation-item-content">';

                    foreach ($msgs as $msg){
                    
$html.=                 '<div class="conversation-item-wrapper">
                            <div class="conversation-item-box">
                                <div class="conversation-item-text">
                                    <p>' . $msg['message_content'] . '</p>
                                    <div class="conversation-item-time">' . $time . '</div>
                                </div>
                                <div class="conversation-item-dropdown">
                                    <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                    <ul class="conversation-item-dropdown-list">
                                        <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                        <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>';

                    }
                        
                        


$html.=           '</div>
                </li>';

        
    
        return $html;
    }

    function generateMessageOtherHTML($id, $msgs, $time) {
        $profileController = new ProfileC();

        $profile = $profileController->getProfileById($id);
    
        // Initialize an empty string to store the HTML
        $html = '<li class="conversation-item">
                    <div class="conversation-item-side">
                        <img class="conversation-item-image" src="data:image/jpeg;base64,' . base64_encode($profile['profile_photo']) . '" alt="">
                    </div>
                    <div class="conversation-item-content">';

                    foreach ($msgs as $msg){
                    
$html.=                 '<div class="conversation-item-wrapper">
                            <div class="conversation-item-box">
                                <div class="conversation-item-text">
                                    <p>' . $msg['message_content'] . '</p>
                                    <div class="conversation-item-time">' . $time . '</div>
                                </div>
                                <div class="conversation-item-dropdown">
                                    <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                    <ul class="conversation-item-dropdown-list">
                                        <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                        <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>';

                    }
                        
                        


$html.=           '</div>
                </li>';

        
    
        return $html;
    }

    function generateConversationHTML($my_profile_id, $other_profile_id) {
        
        $profileController = new ProfileC();

        $msgs = $this->getTwoUsersMessages($my_profile_id, $other_profile_id);

        $groupedMessages = $this->groupMessagesBySender($msgs);

        foreach ($groupedMessages as $groupedMessage) {

            $lastItem = end($groupedMessage);
            $current_id = $lastItem['sender_id'];
            $date_time = $this->extractTimeFromString($lastItem['date_time']);
            
            if ($current_id == $my_profile_id) {
                echo $this->generateMessageMeHTML($current_id, $groupedMessage, $date_time);
            } else {
                echo $this->generateMessageOtherHTML($current_id, $groupedMessage, $date_time);
            }
        }


        



    }

}

?>
