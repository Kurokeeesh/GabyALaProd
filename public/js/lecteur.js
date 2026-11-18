let lastPlayedAudio = null;

document.querySelectorAll(".beat-card").forEach(card => {
    const audio = card.querySelector("audio");
    const track = card.querySelector(".track");
    const elapsed = card.querySelector(".elapsed");
    const trackTime = card.querySelector(".track-time");
    const playButton = card.querySelector(".play-button");
    const pauseButton = card.querySelector(".pause-button");
    const stopButton = card.querySelector(".stop-button");
    const volume = card.querySelector(".volume");
    const volumeValue = card.querySelector(".volume-value");

    function formatTime(t) {
      const m = Math.floor(t / 60);
      const s = Math.floor(t % 60).toString().padStart(2, "0");
      return `${m}:${s}`;
    }

    function updatePlayPauseButtons() {
        if (audio.paused) {
          playButton.style.display = "inline-block";
          pauseButton.style.display = "none";
        } else {
          playButton.style.display = "none";
          pauseButton.style.display = "inline-block";
        }
    }
    
    playButton.addEventListener("click", () => {
        audio.play(), lastPlayedAudio = audio;        ;
        updatePlayPauseButtons();
      });
      
    pauseButton.addEventListener("click", () => {
        audio.pause();
        updatePlayPauseButtons();
    });
      
    stopButton.addEventListener("click", () => {
        audio.pause();
        audio.currentTime = 0;
        updatePlayPauseButtons();
    });
      
    volume.addEventListener("input", () => {
      audio.volume = volume.value;
      volumeValue.textContent = `${Math.round(volume.value * 100)}%`;
    });
    audio.addEventListener("loadedmetadata", () => {
        track.max = audio.duration;
        trackTime.textContent = formatTime(audio.duration); // durée totale
        updatePlayPauseButtons(); // initialise affichage
      });
    if (audio.readyState >= 1) {
        track.max = audio.duration;
        trackTime.textContent = formatTime(audio.duration);
    }
      
    audio.addEventListener("timeupdate", () => {
        track.value = audio.currentTime;
        elapsed.textContent = formatTime(audio.currentTime); // temps écoulé
    });          
    track.addEventListener("input", () => {
      audio.currentTime = track.value;
    });
  });

  document.addEventListener("keydown", (e) => {
    if (e.code === "Space") {
      e.preventDefault();
  
      if (lastPlayedAudio) {
        const beatCard = lastPlayedAudio.closest(".beat-card");
        const playBtn = beatCard.querySelector(".play-button");
        const pauseBtn = beatCard.querySelector(".pause-button");
  
        if (lastPlayedAudio.paused) {
          lastPlayedAudio.play();
          playBtn?.classList.add("hidden");
          pauseBtn?.classList.remove("hidden");
        } else {
          lastPlayedAudio.pause();
          playBtn?.classList.remove("hidden");
          pauseBtn?.classList.add("hidden");
        }
      }
    }
  });
  
  