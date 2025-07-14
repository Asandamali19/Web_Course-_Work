function openModal(title, author, story) {
  document.getElementById('modalTitle').textContent = title;
  document.getElementById('modalAuthor').textContent = "by " + author;
  document.getElementById('modalStory').innerHTML = story;
  document.getElementById('storyModal').style.display = 'block';
}

function closeModal() {
  document.getElementById('storyModal').style.display = 'none';
}

// Close modal if clicked outside content
window.onclick = function(event) {
  var modal = document.getElementById('storyModal');
  if (event.target == modal) {
    closeModal();
  }
}


function searchBooks() {

  const input = document.getElementById("searchInput");
  const filter = input.value.toLowerCase();
  const cards = document.querySelectorAll(".book-card");
  const noResults = document.getElementById("noResults");
  let found = false;

  cards.forEach(card => {
    const title = card.querySelector("h3").textContent.toLowerCase();
    const author = card.querySelector("p").textContent.toLowerCase();

    if (title.includes(filter) || author.includes(filter)) {
      card.style.display = "";
      found=true;
    } else {
      card.style.display = "none"
    }});

    if (!found){
        // alert("😕 Sorry, we couldn't find any books matching your search.");
        // location.reload();
        noResults.classList.add("show")

         setTimeout(() => {
            location.reload();}, 3000);
    }
    else{
         noResults.classList.remove("show");
    }
   
}


