function registerEvent(eventId) {
    // Confirm registration
    if (!confirm('Voulez-vous vraiment vous inscrire à cet événement ?')) {
        return;
    }

    const formData = new FormData();
    formData.append('event_id', eventId);

    fetch('register-event.php', { // Corrected URL
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message); 
            // Optional: Refresh page or update UI
            location.reload(); 
        } else {
            alert(data.message); 
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Une erreur est survenue lors de l\'inscription.');
    });
}


function showEventDetails(eventId) {
    fetch('get_event_details.php?id=' + eventId) // Adjust the URL as necessary
        .then(response => response.json())
        .then(data => {
            document.getElementById('event-description').innerText = data.description; // Assuming your API returns a description
            document.getElementById('event-details').style.display = 'block';
        })
        .catch(error => console.error('Error fetching event details:', error));
}

function showClubDetails(clubId) {
    fetch('get_club_details.php?id=' + clubId) // Adjust the URL as necessary
        .then(response => response.json())
        .then(data => {
            document.getElementById('club-description').innerText = data.description; // Assuming your API returns a description
            document.getElementById('club-details').style.display = 'block';
        })
        .catch(error => console.error('Error fetching club details:', error));
}
