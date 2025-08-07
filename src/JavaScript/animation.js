document.addEventListener('DOMContentLoaded', () => {
  const canvas = document.getElementById('circleAnimation');
  const ctx = canvas.getContext('2d');

  function resize() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  resize();
  window.addEventListener('resize', resize);

  // Enhanced circles with natural movement properties
  const circles = [
    {
      // Large orange circle - orbital movement
      centerX: canvas.width * 0.8,
      centerY: canvas.height * 0.4,
      radius: 200,
      color: 'rgba(255, 165, 0, 0.3)',
      angle: 0,
      orbitRadius: 100,
      speed: 0.008,
      breatheSpeed: 0.005,
      breatheAmount: 20,
      type: 'orbital'
    },
    {
      // Blue circle - sine wave movement
      x: 100,
      y: canvas.height * 0.8,
      radius: 160,
      color: 'rgba(0, 88, 255, 0.25)',
      angle: 0,
      amplitude: 150,
      frequency: 0.01,
      speed: 1.2,
      breatheSpeed: 0.003,
      breatheAmount: 15,
      type: 'wave'
    },
    {
      // Pink circle - floating movement
      x: canvas.width * 0.6,
      y: canvas.height * 0.7,
      radius: 120,
      color: 'rgba(225, 33, 145, 0.2)',
      targetX: canvas.width * 0.6,
      targetY: canvas.height * 0.7,
      speed: 0.02,
      breatheSpeed: 0.007,
      breatheAmount: 25,
      changeTargetTimer: 0,
      type: 'float'
    },
    {
      // Small light blue circle - figure-8 movement
      centerX: canvas.width * 0.4,
      centerY: canvas.height * 0.2,
      radius: 70,
      color: 'rgba(51, 153, 255, 0.4)',
      angle: 0,
      speed: 0.015,
      breatheSpeed: 0.01,
      breatheAmount: 10,
      type: 'figure8'
    },
    {
      // Red circle - spiral movement
      centerX: 80,
      centerY: 150,
      radius: 150,
      color: 'rgba(255, 51, 51, 0.2)',
      angle: 0,
      spiralRadius: 50,
      speed: 0.012,
      breatheSpeed: 0.004,
      breatheAmount: 30,
      type: 'spiral'
    }
  ];

  let time = 0;

  function animateCircle() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    time += 0.016; // Approximately 60fps

    circles.forEach(circle => {
      let x, y, currentRadius;

      // Calculate breathing effect
      const breathe = Math.sin(time * circle.breatheSpeed) * circle.breatheAmount;
      currentRadius = circle.radius + breathe;

      switch (circle.type) {
        case 'orbital':
          // Smooth orbital movement
          circle.angle += circle.speed;
          x = circle.centerX + Math.cos(circle.angle) * circle.orbitRadius;
          y = circle.centerY + Math.sin(circle.angle) * (circle.orbitRadius * 0.6); // Elliptical
          break;

        case 'wave':
          // Sine wave movement across screen
          circle.x += circle.speed;
          if (circle.x > canvas.width + circle.radius) {
            circle.x = -circle.radius;
          }
          circle.angle += circle.frequency;
          x = circle.x;
          y = circle.y + Math.sin(circle.angle) * circle.amplitude;
          break;

        case 'float':
          // Natural floating movement with random target changes
          circle.changeTargetTimer++;
          if (circle.changeTargetTimer > 300) { // Change target every 5 seconds
            circle.targetX = Math.random() * (canvas.width - circle.radius * 2) + circle.radius;
            circle.targetY = Math.random() * (canvas.height - circle.radius * 2) + circle.radius;
            circle.changeTargetTimer = 0;
          }
          
          // Smooth movement towards target with easing
          const dx = circle.targetX - circle.x;
          const dy = circle.targetY - circle.y;
          circle.x += dx * circle.speed;
          circle.y += dy * circle.speed;
          
          x = circle.x;
          y = circle.y;
          break;

        case 'figure8':
          // Figure-8 movement pattern
          circle.angle += circle.speed;
          const scale = 80;
          x = circle.centerX + Math.sin(circle.angle) * scale;
          y = circle.centerY + Math.sin(circle.angle * 2) * (scale * 0.5);
          break;

        case 'spiral':
          // Expanding and contracting spiral
          circle.angle += circle.speed;
          const spiralExpansion = Math.sin(time * 0.3) * 30;
          const currentSpiralRadius = circle.spiralRadius + spiralExpansion;
          x = circle.centerX + Math.cos(circle.angle) * currentSpiralRadius;
          y = circle.centerY + Math.sin(circle.angle) * currentSpiralRadius;
          
          // Slowly move the spiral center
          circle.centerX += Math.sin(time * 0.002) * 0.5;
          circle.centerY += Math.cos(time * 0.003) * 0.3;
          break;
      }

      // Keep circles within bounds
      x = Math.max(currentRadius, Math.min(canvas.width - currentRadius, x));
      y = Math.max(currentRadius, Math.min(canvas.height - currentRadius, y));

      // Draw the circle with gradient for more natural look
      const gradient = ctx.createRadialGradient(x, y, 0, x, y, currentRadius);
      gradient.addColorStop(0, circle.color);
      gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

      ctx.beginPath();
      ctx.arc(x, y, currentRadius, 0, Math.PI * 2, false);
      ctx.fillStyle = gradient;
      ctx.fill();

      // Add subtle glow effect
      ctx.shadowBlur = 20;
      ctx.shadowColor = circle.color;
      ctx.beginPath();
      ctx.arc(x, y, currentRadius * 0.7, 0, Math.PI * 2, false);
      ctx.fillStyle = circle.color;
      ctx.fill();
      ctx.shadowBlur = 0;
    });

    requestAnimationFrame(animateCircle);
  }

  // Handle window resize
  window.addEventListener('resize', () => {
    resize();
    // Update circle positions for new canvas size
    circles.forEach(circle => {
      if (circle.centerX) {
        circle.centerX = Math.min(circle.centerX, canvas.width - circle.radius);
        circle.centerY = Math.min(circle.centerY, canvas.height - circle.radius);
      }
      if (circle.x) {
        circle.x = Math.min(circle.x, canvas.width - circle.radius);
        circle.y = Math.min(circle.y, canvas.height - circle.radius);
      }
    });
  });

  animateCircle();
});
