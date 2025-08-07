document.addEventListener('DOMContentLoaded', () => {
  const message = document.getElementById('message');
  if (message) {
    setTimeout(() => {
      message.style.opacity = '0';
      setTimeout(() => {
        message.remove();
      }, 500); // Give it time to fade out
    }, 3000); // 3 seconds before hiding
  }
});
