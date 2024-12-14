//DROPDOWN PROFILE PHOTO
function toggleDropdown() {
    document.getElementById("dropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.matches('.profile-pic')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                    }
            }
        }
    }


// Kode JavaScript untuk mengelola tampilan latihan

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("mySidenav").style.display = "block";
    
}

function closeNav() {
    document.getElementById("mySidenav").style.display = "none";
}

const exerciseLinks = document.querySelectorAll('.exercise-sidebar li');
const exerciseContents = document.querySelectorAll('.exercise-content');

// Fungsi untuk menampilkan konten latihan yang dipilih
const showExercise = (exerciseId) => {
    // Sembunyikan semua konten latihan
    exerciseContents.forEach(content => {
        content.style.display = 'none';
    });
    
    // Tampilkan konten yang dipilih
    const selectedContent = document.getElementById(exerciseId);
    if (selectedContent) {
        selectedContent.style.display = 'block';
    }
};

// Event listener untuk setiap link latihan
exerciseLinks.forEach(link => {
    link.addEventListener('click', () => {
        const exerciseId = link.getAttribute('data-exercise');
        showExercise(exerciseId);
    });
});

// Tampilkan latihan pertama secara default
showExercise('leg-raise');

// ==========================
// Kode baru untuk dropdown kategori latihan
// ==========================

// Daftar latihan untuk setiap kategori
const exercisesByCategory = {
    "kategori-1": ["Burpee", "Jumping Jack", "Mountain Climber", "High Knees", "Skater Hop", "Bodyweight Squat", "Plank-to-Pushup"],
    "kategori-2": ["Push-Up", "Pull-Up", "Bench Press", "Bicep Curl", "Dumbbell Shoulder Press", "Deadlift", "Lunges"],
    "kategori-3": ["Jog in Place", "Jump Rope", "Butt Kick", "Bear Crawl", "Russian Twists", "Step-Up", "Plankhold"]
};



// Fungsi untuk menampilkan daftar latihan berdasarkan kategori
const displayExercises = (category) => {
    const exerciseList = document.getElementById('exercise-list');
    exerciseList.innerHTML = ''; // Bersihkan daftar latihan sebelumnya

    // Tambahkan latihan berdasarkan kategori yang dipilih
    exercisesByCategory[category].forEach(exercise => {
        const li = document.createElement('li');
        li.textContent = exercise;
        li.setAttribute('data-exercise', exercise.toLowerCase().replace(/\s+/g, '-'));
        exerciseList.appendChild(li);

        // Tambahkan event listener untuk latihan baru
        li.addEventListener('click', () => {
            showExercise(li.getAttribute('data-exercise'));
        });
    });
};

// Elemen dropdown kategori
const categoryButton = document.querySelector('.category-button');
const categoryOptions = document.querySelector('.category-options');

// Event listener untuk toggle dropdown
categoryButton.addEventListener('click', () => {
    categoryOptions.style.display = 
        categoryOptions.style.display === 'flex' ? 'none' : 'flex';
});

// Event listener untuk memilih latihan dari dropdown
categoryOptions.querySelectorAll('p').forEach(option => {
    option.addEventListener('click', () => {
        const category = option.getAttribute('data-category');
        displayExercises(category); // Tampilkan latihan untuk kategori yang dipilih
        categoryOptions.style.display = 'none';
        categoryButton.textContent = option.textContent; // Ubah teks tombol sesuai kategori yang dipilih
    });
});

// Tampilkan daftar latihan default untuk "Membangun Otot"
displayExercises('kategori-1');