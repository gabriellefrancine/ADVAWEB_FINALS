document.addEventListener('DOMContentLoaded', () => {
  const canvas = document.getElementById('circleAnimation');
  const ctx = canvas.getContext('2d');

  function resize() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  resize();
  window.addEventListener('resize', resize);

  // Define 4 moving circles
  const circles = [
    { posX: 1300, direction: 1, y: 400, r: 200, color: '#ffa500', speed: 1.5 },   // Pink
    { posX: 100, direction: -1, y: 820, r: 160, color: '#0058ff', speed: 2 },    // Blue
    { posX: 900, direction: -1, y: 750, r: 120, color: '#e12191ff', speed: 1 },  // Orange
    { posX: 700, direction: 1, y: 150, r: 70, color: '#3399ff', speed: 1.2 },
    { posX: 80, direction: 1, y: 150, r: 150, color: '#ff3333ff', speed: 1.2 }, // Light Blue#0058ff
  ];

  function animateCircle() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    circles.forEach(circle => {
      
      circle.posX += circle.speed * circle.direction;

      // Reverse direction at edges
      if (circle.posX - circle.r < 0 || circle.posX + circle.r > canvas.width) {
        circle.direction *= -1;
      }

      // Draw the circle
      ctx.beginPath();
      ctx.arc(circle.posX, circle.y, circle.r, 0, Math.PI * 2, false);
      ctx.fillStyle = circle.color;
      ctx.fill();
    });

    requestAnimationFrame(animateCircle);
  }

  animateCircle();
});
