document.addEventListener("DOMContentLoaded", () =>
    {
    const addBtn = document.getElementById("add-btn");
    const Question = document.getElementById("question");
    const Answer = document.getElementById("answer");
    const errorMessage = document.getElementById("errorMessage");
    const successMessage = document.getElementById("successMessage");

    addBtn.addEventListener("click", async (event) => {
        event.preventDefault(); 

        try {
            const response = await axios.post
            (
                "http://localhost/Article/Article-server/client/v1/add_questions.php",
                {
                    question: Question.value,
                    answer: Answer.value
                },
                {
                    headers: {
                        "Content-Type": "application/json",
                    }
                }
            );

            console.log(response);

            if (response.data.success) {
                successMessage.tectContent = response.data.message;
            } else {
                errorMessage.textContent = response.data.message; 
            }

        } catch (error) {
            console.error('error:', error);
            errorMessage.textContent = "Adding question failed. Please try again.";
        }
    });
});
