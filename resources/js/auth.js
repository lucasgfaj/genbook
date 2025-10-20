function typeWriteLoop(element, speed = 100, pause = 1500) {
    const text = element.textContent;
    element.textContent = "";

    function writeText() {
      element.textContent = "";
      text.split("").forEach((letter, i) => {
        setTimeout(() => {
          element.textContent += letter;

          if (i === text.length - 1) {
            setTimeout(() => eraseText(), pause);
          }
        }, speed * i);
      });
    }

    function eraseText() {
      let i = text.length;
      const interval = setInterval(() => {
        element.textContent = text.substring(0, i--);
        if (i < 0) {
          clearInterval(interval);
          setTimeout(() => writeText(), 500);
        }
      }, 50); 
    }

    writeText();
  }

  const title = document.querySelector(".writing");
  typeWriteLoop(title, 100, 2000); 