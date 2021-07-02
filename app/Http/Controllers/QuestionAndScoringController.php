<?php

namespace App\Http\Controllers;

class QuestionAndScoringController extends Controller
{
    public static function index() {
        return [
            [
                "id" => 1,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "How much do these statements sound like you?",
                    "title" => "Rules exist for a reason and it frustrates me when people don't follow them.",
                    "questions" => [
                        "<b>Welcome!</b><br> We are so glad you are taking the enneagram assessment. When answering the following questions it is best to go with what comes to your mind first and not over think it.",
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type1',
                ],
            ],
            [
                "id" => 2,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I have any extremely loud inner critic.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type1',
                ],
            ],
            [
                "id" => 3,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I hold myself to a high standard and expect others to do the same.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type1',
                ],
            ],
            [
                "id" => 4,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "There's a right way and a wrong way to do things.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type1',
                ],
            ],
            [
                "id" => 5,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "Rules are suggestions. I like finding new ways to do things.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 5
                        ],
                        [
                            "title" => "2",
                            "value" => 4
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 2
                        ],
                        [
                            "title" => "5",
                            "value" => 1
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type1',
                    // "negative" => true,
                ],
            ],
            [
                "id" => 6,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I can easily identify flaws.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type1',
                ],
            ],
            [
                "id" => 7,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I become more playful and relaxed with those closest to me.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type1',
                ],
            ],
            [
                "id" => 8,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "Giving to and serving others is my main focus.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type2',
                ],
            ],
            [
                "id" => 9,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "When I do something for someone I expect appreciation.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type2',
                ],
            ],
            [
                "id" => 10,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I can typically tell when others need my help. ",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type2',
                ],
            ],
            [
                "id" => 11,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I enjoy creating a welcoming environment.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type2',
                ],
            ],
            [
                "id" => 12,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "Giving to others is not as important as being successful.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 5
                        ],
                        [
                            "title" => "2",
                            "value" => 4
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 2
                        ],
                        [
                            "title" => "5",
                            "value" => 1
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type2',
                    // "negative" => true,
                ],
            ],
            [
                "id" => 13,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "Those who know me well might say I am \"needy.\"",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type2',
                ],
            ],
            [
                "id" => 14,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "The appearance of success is important to me.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type3',
                ],
            ],
            [
                "id" => 15,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I'm easily able to blend in with various groups of people.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type3',
                ],
            ],
            [
                "id" => 16,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I find my value in my accomplishments.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type3',
                ],
            ],
            [
                "id" => 17,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I don't mind sharing my failures.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 5
                        ],
                        [
                            "title" => "2",
                            "value" => 4
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 2
                        ],
                        [
                            "title" => "5",
                            "value" => 1
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type3',
                    // "negative" => true,
                ],
            ],
            [
                "id" => 18,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "Winning is most important.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type3',
                ],
            ],
            [
                "id" => 19,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "Only those closest to me hear about my doubts and frustrations.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type3',
                ],
            ],
            [
                "id" => 20,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "It is important to stand out from the crowd with a unique and special approach.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type4',
                ],
            ],
            [
                "id" => 21,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I don't like being told to move on when dealing with my emotions.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type4',
                ],
            ],
            [
                "id" => 22,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "Being compared to others is extremely annoying.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type4',
                ],
            ],
            [
                "id" => 23,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I handle criticism very well.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 5
                        ],
                        [
                            "title" => "2",
                            "value" => 4
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 2
                        ],
                        [
                            "title" => "5",
                            "value" => 1
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type4',
                    // "negative" => true,
                ],
            ],
            [
                "id" => 24,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I become more critical of myself and others when speaking to close friends.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type4',
                ],
            ],
            [
                "id" => 25,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I want to blend in, I don't like to be seen as standing out. ",

                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 5
                        ],
                        [
                            "title" => "2",
                            "value" => 4
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 2
                        ],
                        [
                            "title" => "5",
                            "value" => 1
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type4',
                    // "negative" => true,
                ],
            ],
            [
                "id" => 26,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "It's important that we have all the information before we move into action.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type5',
                ],
            ],
            [
                "id" => 27,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I am slow to give my opinion but quick to ask questions.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type5',
                ],
            ],
            [
                "id" => 28,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "It frustrates me when people are not organized.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type5',
                ],
            ],
            [
                "id" => 29,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I enjoy random visits from friends or co-workers.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 5
                        ],
                        [
                            "title" => "2",
                            "value" => 4
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 2
                        ],
                        [
                            "title" => "5",
                            "value" => 1
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type5',
                    // "negative" => true,
                ],
            ],
            [
                "id" => 30,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "If I am comfortable around you I don't mind arguing and interjecting my opinion.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type5',
                ],
            ],
            [
                "id" => 31,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "It's important to me to ensure we plan for all possible scenarios.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type6',
                ],
            ],
            [
                "id" => 32,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "Sometimes my anxiety keeps me from taking action.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type6',
                ],
            ],
            [
                "id" => 33,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I do my best work when I have clear guidance and instructions.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type6',
                ],
            ],
            [
                "id" => 34,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I trust my instincts and quickly move into action.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 5
                        ],
                        [
                            "title" => "2",
                            "value" => 4
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 2
                        ],
                        [
                            "title" => "5",
                            "value" => 1
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type6',
                    // "negative" => true,
                ],
            ],
            [
                "id" => 35,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "Those closest to me would say I am passive-aggressive.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type6',
                ],
            ],
            [
                "id" => 36,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "When I am stressed I like to stay busy to avoid anxiety.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type6',
                ],
            ],
            [
                "id" => 37,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I don't want to miss out on an opportunity to celebrate.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type7',
                ],
            ],
            [
                "id" => 38,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I would rather build something than maintain a system.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type7',
                ],
            ],
            [
                "id" => 39,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I would hate to be trapped in the same position for a prolonged period of time.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type7',
                ],
            ],
            [
                "id" => 40,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I don't enjoy social gatherings.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 5
                        ],
                        [
                            "title" => "2",
                            "value" => 4
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 2
                        ],
                        [
                            "title" => "5",
                            "value" => 1
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type7',
                    // "negative" => true,
                ],
            ],
            [
                "id" => 41,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I am typically optimistic but I am comfortable sharing my pessimistic views if I trust someone.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type7',
                ],
            ],
            [
                "id" => 42,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "People in my business/life would say I am aggressive.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type8',
                ],
            ],
            [
                "id" => 43,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "Making big decisions is easy to me.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type8',
                ],
            ],
            [
                "id" => 44,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "If someone doesn't step in to lead, I will.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type8',
                ],
            ],
            [
                "id" => 45,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "When I see someone being overlooked or bullied I spring into action.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type8',
                ],
            ],
            [
                "id" => 46,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I am quick to give my opinion but slow to ask questions.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type8',
                ],
            ],
            [
                "id" => 47,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "It is easy to share my weaknesses.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 5
                        ],
                        [
                            "title" => "2",
                            "value" => 4
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 2
                        ],
                        [
                            "title" => "5",
                            "value" => 1
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type8',
                    // "negative" => true,
                ],
            ],
            [
                "id" => 48,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I tend to overstep relational bounds with those I am closest to.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type8',
                ],
            ],
            [
                "id" => 49,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "When in a meeting it is easy for me to withdraw from the conversation.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type9',
                ],
            ],
            [
                "id" => 50,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "Conflict of any kind makes me very uncomfortable.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type9',
                ],
            ],
            [
                "id" => 51,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "When having a conversation I find it easy to empathize and connect with others.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type9',
                ],
            ],
            [
                "id" => 52,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "People are comfortable confiding in me.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type9',
                ],
            ],
            [
                "id" => 53,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I am quick to insert my opinion.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 5
                        ],
                        [
                            "title" => "2",
                            "value" => 4
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 2
                        ],
                        [
                            "title" => "5",
                            "value" => 1
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type9',
                    // "negative" => true,
                ],
            ],
            [
                "id" => 54,
                "public" => [
                    "response" => null,
                    "complete" => false,
                    "type" => 'likert',
                    "helperText" => true,
                    "fade" => true,
                    "subtitle" => "",
                    "title" => "I'm not generally needy but like to be affirmed by those closest to me.",
                    "questions" => [
                    ],
                    "answers" => [
                        [
                            "title" => "1",
                            "value" => 1
                        ],
                        [
                            "title" => "2",
                            "value" => 2
                        ],
                        [
                            "title" => "3",
                            "value" => 3
                        ],
                        [
                            "title" => "4",
                            "value" => 4
                        ],
                        [
                            "title" => "5",
                            "value" => 5
                        ],
                    ],
                ],
                "private" => [
                    "category" => 'type9',
                ],
            ],
            [
                "id" => 55,
                "public" => [
                    "response" => '',
                    "complete" => false,
                    "type" => 'button',
                    "questions" => [],
                    "answers" => [],
                ],
                "private" => [
                ]
            ],
        ];
    }

    public static function get_public() {

        $questions = self::index();

        return collect($questions)->map( function($question) {
            return array_merge(
                ["id" =>$question["id"]],
                $question["public"]
            );
        });

    }

    public static function get_all() {

        $questions = self::index();

        return collect($questions)->map( function($question) {
            return array_merge(
                ["id" =>$question["id"]],
                $question["public"],
                $question["private"]
            );
        });

    }
}
