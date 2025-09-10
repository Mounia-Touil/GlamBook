document.addEventListener('DOMContentLoaded', () => {
  const currentUser = JSON.parse(localStorage.getItem('glam_current_user'));
  if (!currentUser) {
    alert('You must log in first!');
    window.location.href = 'login.html';
    return;
  }

  document.getElementById('userName').innerText = currentUser.name;

  const services = [
    { name: 'Haircut', duration: '45 min', price: '$40' },
    { name: 'Makeup', duration: '60 min', price: '$65' },
    { name: 'Facial', duration: '50 min', price: '$55' },
    { name: 'Manicure', duration: '30 min', price: '$25' }
  ];

  const container = document.getElementById('servicesList');
  services.forEach(service => {
    const card = document.createElement('div');
    card.className = 'col-md-6 col-lg-4';
    card.innerHTML = `
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">${service.name}</h5>
          <p class="card-text">${service.duration} · ${service.price}</p>
          <a href="booking.html?service=${encodeURIComponent(service.name)}" class="btn btn-purple">Book Now</a>
        </div>
      </div>
    `;
    container.appendChild(card);
  });
});