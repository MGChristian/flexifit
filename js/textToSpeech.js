document.addEventListener("DOMContentLoaded", () => {
  // Check for speech recognition support
  const SpeechRecognition =
    window.SpeechRecognition || window.webkitSpeechRecognition;

  if (SpeechRecognition) {
    const recognition = new SpeechRecognition();
    recognition.lang = "en-US";
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;

    const micButton = document.getElementById("micButton");
    const input = document.getElementById("searchInput");
    const searchForm = document.querySelector(".search-container form");

    micButton.addEventListener("click", (e) => {
      e.preventDefault();
      try {
        recognition.start();
        micButton.disabled = true;
        micButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
        micButton.title = "Listening...";
      } catch (err) {
        console.error("Speech recognition error:", err);
        resetMicButton();
      }
    });

    recognition.onresult = (event) => {
      const transcript = event.results[0][0].transcript;
      input.value = transcript;
      // Don't auto-submit - let user review first
    };

    recognition.onerror = (event) => {
      console.error("Recognition error:", event.error);
      alert("Voice recognition failed: " + event.error);
      resetMicButton();
    };

    recognition.onend = () => {
      if (!micButton.disabled) return;
      resetMicButton();
    };

    function resetMicButton() {
      micButton.disabled = false;
      micButton.innerHTML = '<i class="fa fa-microphone"></i>';
      micButton.title = "Voice Search";
    }

    // Optional: Add visual feedback while listening
    recognition.onsoundstart = () => {
      micButton.style.color = "red";
    };

    recognition.onsoundend = () => {
      micButton.style.color = "";
    };
  } else {
    // Hide mic button if not supported
    micButton.style.display = "none";
    console.warn("Speech Recognition not supported in this browser.");
  }
});
