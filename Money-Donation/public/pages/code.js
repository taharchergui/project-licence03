document.addEventListener('DOMContentLoaded', () => {
    loadDonations();
    loadUsers();
  });
  
  const donations = [
    { username: 'TAHAR', project: 'Projet A', amount: '50000DZD', paymentMethod: 'Carte de Crédit', date: '2023-05-01' },
    { username: 'Bob', project: 'Projet B', amount: '1000DZD', paymentMethod: 'carte dhabia', date: '2023-05-10' },
  ];
  
  const users = [
    { firstName: 'Admin', lastName: 'User', email: 'admin@example.com', role: 'Bénificateur', phone: '1234567890' },
    { firstName: 'User', lastName: 'One', email: 'user1@example.com', role: 'donateur', phone: '0987654321' },
  ];
  
  function loadDonations() {
    const donationsTable = document.getElementById('donationsTable');
    donationsTable.innerHTML = '';
    donations.forEach(donation => {
      const row = `<tr>
        <td>${donation.username}</td>
        <td>${donation.project}</td>
        <td>${donation.amount}</td>
        <td>${donation.paymentMethod}</td>
        <td>${donation.date}</td>
      </tr>`;
      donationsTable.innerHTML += row;
    });
  }
  
  function loadUsers() {
    const usersTable = document.getElementById('usersTable');
    usersTable.innerHTML = '';
    users.forEach((user, index) => {
      const row = `<tr>
        <td>${user.firstName} ${user.lastName}</td>
        <td>${user.role}</td>
        <td><button onclick="deleteUser(${index})" class="btn btn-danger">Supprimer</button></td>
      </tr>`;
      usersTable.innerHTML += row;
    });
  }
  
  function createUser() {
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const role = document.getElementById('role').value;
    const phone = document.getElementById('phone').value;
    const password = document.getElementById('password').value;
  
    if (firstName && lastName && email && role && phone && password) {
      users.push({ firstName, lastName, email, role, phone });
      loadUsers();
      document.getElementById('userForm').reset();
    } else {
      alert('Veuillez remplir tous les champs du formulaire');
    }
  }
  
  function deleteUser(index) {
    users.splice(index, 1);
    loadUsers();
  }
  