document.addEventListener("DOMContentLoaded", function () {
    const memberForm = document.getElementById('member-form');
    const memberAddButton = document.getElementById('add-member');
    const memberCount = document.getElementById('member-count');
    const memberMaxFields = 20;
    let memberIndex = 1;

    memberAddButton.addEventListener('click', function () {
        if (memberIndex < memberMaxFields) {
            memberIndex++;
            const newField = document.createElement('div');
            newField.classList.add('form-group');
            newField.classList.add('mb-3');
            newField.id = `member-${memberIndex}`;
            newField.innerHTML = `
            <label class="text-sm" for="">${memberIndex}. Members</label>
            <div class="input-group">
                <input type="text" id="" class="form-control" name="member_${memberIndex}" placeholder="Member ${memberIndex}" required>
                <button type="button" class="btn btn-danger px-3" id="${memberIndex}"><i class="bi bi-dash-lg" id="${memberIndex}"></i></button>
            </div>
            `;
            memberForm.appendChild(newField);
            memberCount.value = memberIndex;

            const memberFocus = newField.querySelector('input');
            if (memberFocus) {
                memberFocus.focus();
            }
       } 
    });

    memberForm.addEventListener('click', function(event) {
        const memberInputIndex = parseInt(event.target.id);
        if (memberIndex == memberInputIndex) {
            const memberElementRemove = document.getElementById(`member-${memberIndex}`);
            if (memberElementRemove) {
                memberElementRemove.remove();
                memberIndex--;
                memberCount.value = memberIndex;
            }
        } else {
            console.log(memberIndex);
            console.log(memberInputIndex);
        }
    });

});