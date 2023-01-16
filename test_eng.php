<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ukraine 2010 President Election</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body>
  <div class="container main">
    <div class="sticky-top mynav-container">
                <a href="/index_eng.html" class="link-secondary mynav minor"><img src="/img/home.png" alt="homepage"></a>
                <a href="/programs_eng.html" class="link-secondary mynav">PROGRAMS</a>
                <a href="/test_eng.php" class="link-secondary mynav"><u><b>TEST</b></u></a>
                <a href="/contact_eng.html" class="link-secondary mynav">CONTACTS</a>
                <a href="/test.php" class="link-secondary mynav lang">Ua</a>
            </div>
          <div class="text-center"><a href="/index_eng.html"><img src="/img/top2.jpg" alt="logo"></a></div>
<?php
# check if the request was made after submitting the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
        $out = '<br><h4 style="color: red;">TEST RESULT:</h4><br>';

        $candidades = file("db/candidades_eng.txt");
        $candidade_count = count($candidades);

        # initialize scores of the cadidades with initial 0 value
        $candidades_score = array_fill(0, $candidade_count, 0);

        $answers = file("db/answers.txt");
        $answers_count = count($answers);

        # iterate over each question answers
        for ($question = 0; $question < $answers_count; $question++) {
                # split one concrete answer set by separator '|'
                $one_answer = explode("|", trim($answers[$question]));
                # catch answer POSTed from form
                $offset = (int)$_POST["q$one_answer[0]"];
                # iterate over one question answers set
                # grant score to each of candidade
                for ($candidade = 0; $candidade < $candidade_count; $candidade++) {
                        $candidades_score[$candidade] += $one_answer[$candidade_count * ($offset - 1) + ($candidade + 1)];
                }
        }
        # print_r($candidades_score);
        # sort the scores
        arsort($candidades_score);
        
        # define the place var for further using in printing loop
        $place = 0;

        foreach ($candidades_score as $nominee => $score) {
                $place += 1;
                $out .= "$place. $candidades[$nominee] $score concurrences<hr>";
        }

        $out .= '<a href="/test_eng.php"><b>« Do once again</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index_eng.html">« To homepage</a><br><br><br>';
} else {
  
        $question_list = file("db/questions_eng.txt");
        $questions_count = count($question_list);

        $out = '<h5>Ukraine President Election 2010 🇺🇦</h5>';
        $out .= '<form method="post" onsubmit="return formValidation()">';

        for ($question = 0; $question < $questions_count; $question++) {
                $one_question = explode("|", trim($question_list[$question]));
                $out .= "<br><fieldset>";
                $out .= "<legend style=\"background-color:#d7eaf5\"><span class=\"small\">$one_question[0].</span> <i>$one_question[1]</i></legend>";
                for ($option = 0; $option < count($one_question) - 2; $option++) {
                        $out .= '<p><input name="q' . $one_question[0] . '" type="radio" value="' . ($option+1) . '" >';
                        $out .= "{$one_question[$option + 2]}</p>";
                }
                $out .= '</fieldset>';
        }
        $out .= '<br><button type="submit" class="btn btn-primary">VOTE</button><br><br></form>'; 
}
echo $out;
?>
</div>
<script src="script_eng.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</body>
</html>