document.addEventListener("DOMContentLoaded", () => {
    const faqsContainer = document.getElementById("faqsContainer");
    const searchForm = document.getElementById("searchForm");
    const searchQuery = document.getElementById("searchQuery");
    const errorMessage = document.createElement("p");

    async function fetchFAQs() {
        try {
            const response = await axios.get("http://localhost/Article/Article-server/client/v1/get_questions.php", {
                headers: {
                    "Content-Type": "application/json",
                }
            });

            if (response.data.success) {
                displayFAQs(response.data.questions);
            } else {
                throw new Error(response.data.message || 'Failed to load FAQs');
            }
        } catch (error) {
            errorMessage.textContent = error.message || "Failed to load FAQs. Please try again.";
            faqsContainer.appendChild(errorMessage);
        }
    }

    function displayFAQs(questions) {
        questions.forEach(question => {
            const faqBox = createFAQBox(question);
            faqsContainer.appendChild(faqBox);
        });
    }

    function createFAQBox(question) {
        const box = document.createElement('div');
        box.className = 'box';

        const questionHeader = document.createElement('h3');
        questionHeader.textContent = question.question;
        questionHeader.className = 'faq-question';
        box.appendChild(questionHeader);

        const answerParagraph = document.createElement('p');
        answerParagraph.textContent = question.answer;
        answerParagraph.className = 'faq-answer';
        box.appendChild(answerParagraph);

        return box;
    }

    function filterFAQs(searchText) {
        const faqs = faqsContainer.querySelectorAll('.box');
        faqs.forEach(faq => {
            const question = faq.querySelector('.faq-question').textContent.toLowerCase();
            const answer = faq.querySelector('.faq-answer').textContent.toLowerCase();
            if (question.includes(searchText) || answer.includes(searchText)) {
                faq.style.display = '';
            } else {
                faq.style.display = 'none'; 
            }
        });
    }

    searchForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const searchText = searchQuery.value.toLowerCase();
        filterFAQs(searchText);
    });

    document.getElementById('addNewBtn').addEventListener('click', function() {
        window.location.href = 'faq.html';
    });
    
    fetchFAQs();
});
