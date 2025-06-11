document.addEventListener("DOMContentLoaded", () => {
  if (window.SpeechRecognition) {
    const recognition = new SpeechRecognition();
    recognition.lang = "en-US";
    recognition.interimResults = false;

    const micButton = document.getElementById("micButton");
    const input = document.getElementById("exerciseInput");

    micButton.addEventListener("click", () => {
      recognition.start();
      micButton.disabled = true;
      micButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    });

    recognition.addEventListener("result", (event) => {
      const transcript = event.results[0][0].transcript;
      input.value = transcript;
    });

    recognition.addEventListener("end", () => {
      micButton.disabled = false;
      micButton.innerHTML = '<i class="fas fa-microphone"></i>';
      // Optionally submit form automatically:
      micButton.closest("form").submit();
    });
  } else {
    // Hide mic button if not supported
    document.getElementById("micButton").style.display = "none";
    console.warn("Speech Recognition not supported in this browser.");
  }
});
