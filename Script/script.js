/** @format */

const task = document.getElementById("task");
const date = document.getElementById("date");
const priority = document.getElementById("priority");
const list = document.getElementById("list");
const add = document.getElementById("add");

// // Add Task & Check Task & Delete Task
// add.onclick = function () {
// 	if (task.value === "" || date.value === "" || priority.value === "") {
// 		alert("Please fill in all fields");
// 		return;
// 	}

// 	// Get Values
// 	const taskValue = task.value;
// 	const dateValue = date.value;
// 	let priorityValue = priority.value;
// 	if (priorityValue === "1") {
// 		priorityValue = "Low";
// 	} else if (priorityValue === "2") {
// 		priorityValue = "High";
// 	}

// 	// Create Task
// 	const li = document.createElement("li");
// 	li.className = "item";
// 	li.innerHTML = `
// 									<div class="icon">
//                     <i class="fa-regular fa-square"></i>
//                   </div>
//                   <div class="task">
//                     <span>${taskValue}</span>
//                     <span>${dateValue}</span>
//                     <span>${priorityValue}</span>
//                   </div>
// 									<div class="delete">
//                     <i class="fas fa-trash"></i>
//                   </div>`;
// 	list.appendChild(li);

// 	// Check Task
// 	const checkBox = document.querySelectorAll(".fa-square");
// 	checkBox.forEach((checkmark) => {
// 		checkmark.onclick = function () {
// 			checkmark.parentNode.parentNode.classList.toggle("completed");
// 			checkmark.classList.toggle("fa-square");
// 			checkmark.classList.toggle("fa-check-square");
// 		};
// 	});

// 	// Delete Task
// 	const deleteTask = document.querySelectorAll(".delete");
// 	deleteTask.forEach((trash) => {
// 		trash.onclick = function () {
// 			trash.parentNode.remove();
// 		};
// 	});
// };

// Check Task
const checkBox = document.querySelectorAll(".fa-square");
checkBox.forEach((checkmark) => {
	checkmark.onclick = function () {
		checkmark.parentNode.parentNode.classList.toggle("completed");
		checkmark.classList.toggle("fa-square");
		checkmark.classList.toggle("fa-check-square");
	};
});
