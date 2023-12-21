// Sample discussion data
let discussions = [
  {
    id: 1,
    title: "Concert Angèle Paris Oct.2023",
    content: "Details about the concert...",
    username: "MusicLover99",
  },
  {
    id: 2,
    title: "QUAND NOUVEL ALBUM DAMSO ? 2025 ?",
    content: "Discussion about Damso's new album...",
    username: "Rap03",
  },
  {
    id: 3,
    title: "Meilleur chanteur d'opéra 2023?",
    content: "Debate on the best opera singer...",
    username: "Ariaaa",
  },
];

// Function to populate the discussion list
function populateDiscussionList() {
  const discussionList = document.getElementById("discussionList");

  discussions.forEach((discussion) => {
    const discussionItem = document.createElement("div");
    discussionItem.classList.add("discussion-item");
    discussionItem.textContent =
      discussion.title + " by " + discussion.username;

    // Event listener to handle clicking on discussion items
    discussionItem.addEventListener("click", () => {
      openDiscussionModal(discussion);
    });

    discussionList.appendChild(discussionItem);
  });
}

// Function to open discussion in modal
function openDiscussionModal(discussion) {
  // Implementation of the modal opening goes here
  console.log("Clicked on discussion:", discussion.title);
}

// Function to create a discussion
function createDiscussion() {
  const titleInput = document.getElementById("discussionTitle").value;
  const contentInput = document.getElementById("discussionContent").value;
  const usernameInput = document.getElementById("username").value;

  if (titleInput && contentInput && usernameInput) {
    const newDiscussion = {
      id: discussions.length + 1,
      title: titleInput,
      content: contentInput,
      username: usernameInput,
    };

    discussions.push(newDiscussion);

    // Clear input fields after creating discussion
    document.getElementById("discussionTitle").value = "";
    document.getElementById("discussionContent").value = "";
    document.getElementById("username").value = "";

    // Repopulate the discussion list with the updated data
    document.getElementById("discussionList").innerHTML = "";
    populateDiscussionList();
  } else {
    alert(
      "Veuillez remplir les champs suivants (titre, message, and username)!"
    );
  }
}

// Call the function to populate the discussion list when the page loads
window.addEventListener("DOMContentLoaded", populateDiscussionList);
