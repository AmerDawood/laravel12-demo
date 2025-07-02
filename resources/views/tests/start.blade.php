<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Start Test - SmartExam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div id="question-box" class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span>📘 Question <span id="question-number">1</span> / {{ count($questions) }}</span>
                    <span id="timer" class="badge bg-warning text-dark">⏳ 30s</span>
                </div>
                <div class="card-body" id="question-body">
                    <h5>Loading question...</h5>
                </div>
                <div class="card-footer text-end">
                    <button id="next-btn" class="btn btn-success">Next ➡️</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const questions = @json($questions);
    let current = 0;
    let timer;
    let questionTime = 30; // seconds

    function renderQuestion(index) {
        if (index >= questions.length) {
            document.getElementById('question-box').innerHTML = `
                <div class="alert alert-success text-center">
                    ✅ You've completed the test!
                </div>
            `;
            return;
        }

        const q = questions[index];
        document.getElementById('question-number').innerText = index + 1;

        let html = `<p class="mb-3"><strong>${q.question_text}</strong></p>`;

        if (q.type === 'mcq' && q.options) {
            const options = JSON.parse(q.options);
            html += options.map((opt, i) => `
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="option" id="opt${i}">
                    <label class="form-check-label" for="opt${i}">${opt}</label>
                </div>
            `).join('');
        } else if (q.type === 'written') {
            html += `<textarea class="form-control" rows="4" placeholder="Write your answer here..."></textarea>`;
        } else if (q.type === 'coding') {
            html += `<textarea class="form-control" rows="8" placeholder="Write your code here..."></textarea>`;
        } else if (q.type === 'true_false') {
            html += `
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="option" id="trueOpt">
                    <label class="form-check-label" for="trueOpt">True</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" id="falseOpt">
                    <label class="form-check-label" for="falseOpt">False</label>
                </div>
            `;
        }

        document.getElementById('question-body').innerHTML = html;
        resetTimer();
    }

    function resetTimer() {
        clearInterval(timer);
        let time = questionTime;
        document.getElementById('timer').innerText = `⏳ ${time}s`;

        timer = setInterval(() => {
            time--;
            document.getElementById('timer').innerText = `⏳ ${time}s`;
            if (time <= 0) {
                clearInterval(timer);
                goToNextQuestion();
            }
        }, 1000);
    }

    function goToNextQuestion() {
        current++;
        renderQuestion(current);
    }

    document.getElementById('next-btn').addEventListener('click', goToNextQuestion);

    renderQuestion(current);
</script>

</body>
</html>
