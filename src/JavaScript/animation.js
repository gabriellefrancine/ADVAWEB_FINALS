document.addEventListener('DOMContentLoaded', () => {
  const canvas = document.getElementById('circleAnimation');
  const ctx = canvas.getContext('2d');

  function resize() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  resize();
  window.addEventListener('resize', resize);

  // Four animated circles resembling the image
  const circles = [
    { x: 0, y: 150, r: 100, color: '#ff00b3', speed: 1.5, direction: 1 },   // Pink (bottom-left)
    { x: 200, y: 500, r: 90, color: '#0058ff', speed: 2, direction: 1 },    // Blue (lower middle)
    { x: 500, y: 100, r: 120, color: '#ffa500', speed: 1, direction: -1 },  // Orange (top-right)
    { x: 900, y: 200, r: 70, color: '#3399ff', speed: 1.2, direction: -1 }, // Lighter blue (upper mid-right)
  ];

  function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    circles.forEach(circle => {
      // Move circle
      circle.x += circle.speed * circle.direction;

      // Bounce back at canvas edges
      if (circle.x - circle.r < 0 || circle.x + circle.r > canvas.width) {
        circle.direction *= -1;
      }

      // Draw circle
      ctx.beginPath();
      ctx.arc(circle.x, circle.y, circle.r, 0, Math.PI * 2);
      ctx.fillStyle = circle.color;
      ctx.fill();
    });

    requestAnimationFrame(animate);
  }

  animate();
});
