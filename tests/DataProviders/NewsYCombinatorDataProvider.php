<?php

namespace Tests\DataProviders;

class NewsYCombinatorDataProvider
{

    public function standard_data_provider()
    {
        return [
            'standard' => [
                [
                    [
                        "1.",
                        "Classifying Python virtual environment workflows",
                        "49 points",
                        "29 comments",
                        ""
                    ]
                ],
                [
                    [
                        "rank" => 1,
                        "title" => "Classifying Python virtual environment workflows",
                        "points" => 49,
                        "comments" => 28,
                    ],
                ]
            ]
        ];
    }

    public function missing_points_invalid_comments_data_provider()
    {
        return [
            'missing_points_invalid_comments' => [
                [
                    [
                        "2.",
                        "6 Universal flu vaccine against all known subtypes takes promising first steps",
                        "discuss",
                        ""
                    ]
                ],
                [
                    [
                        "rank" => 2,
                        "title" => "6 Universal flu vaccine against all known subtypes takes promising first steps",
                        "points" => 0,
                        "comments" => 0,
                    ],
                ]
            ]
        ];
    }

    public function invalid_comments_data_provider()
    {
        return [
            'invalid_comments' => [
                [
                    [
                        "3.",
                        "24 ESP32-P4: High-performance MCU with IO-connectivity and security features",
                        "49 points",
                        "discuss",
                        ""
                    ]

                ],
                [
                    [
                        "rank" => 3,
                        "title" => "24 ESP32-P4: High-performance MCU with IO-connectivity and security features",
                        "points" => 49,
                        "comments" => 0,
                    ],
                ]
            ]
        ];
    }

    public function missing_points_data_provider()
    {
        return [
            'missing_points' => [
                [
                    [
                        "5.",
                        "21 Show HN: I Made a Logo Marketplace",
                        "29 comments",
                        " ",
                    ]

                ],
                [
                    [
                        "rank" => 5,
                        "title" => "21 Show HN: I Made a Logo Marketplace",
                        "points" => 0,
                        "comments" => 29,
                    ],
                ]
            ]
        ];
    }

    public function missing_comments_data_provider()
    {
        return [
            'missing_comments' => [
                [
                    [

                        "6.",
                        "13 The Rise of Steel – Part I",
                        "29 points",
                        " ",
                    ]
                ],
                [
                    [
                        "rank" => 6,
                        "title" => "Will We Know Alien Life When We See It?",
                        "points" => 29,
                        "comments" => 0,
                    ],
                ]
            ]
        ];
    }
}
