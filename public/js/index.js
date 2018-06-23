const form = document.querySelector("#create"); 
const options = document.querySelector("#options");  
const modal = document.querySelector("modal");
const createPoll = event => {
    //debugger;
    // Stop the form from submitting since we’re handling that with AJAX.
    event.preventDefault();

    const formData = new FormData(form);

//     const body = {
//         body: formData,
//         //method: "POST",
//         //credentials: "same-origin",
//         headers: {
//             // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//           }
//     }

//     // fetch("/polls", body)
//     // .then(res => res.text())
//     // .then(res => {
//     //    // console.log(res);
//     //     //console.log(res.replace(/<(?:.|\n)*?>/gm, ''));

//     //     // let id = res.replace(/<(?:.|\n)*?>/gm, '');
//     //     // let url = documen t.createElement('a');
//     //     // url.textContent = "Here is your poll";
//     //     // url.href = `views/vote/${id}`;
//     //     // console.log(url);
//     //     // document.querySelector(".container").appendChild(url);
//     // })
//     // .catch(error => console.error(`Error: ${error}`));

//     // axios.post("/polls", body)
//     // .then(res=> console.log(res));

    const clip = (url) => clipboard.readText(url); 
    const success = (id)=> {
        //${id}
        let url = document.createElement('a');
        url.textContent = `${window.location.href}poll/${id}`;
        url.href = `${window.location.href}poll/${id}`;
        let copy = document.createElement("button");
        copy.className = "btn btn-info copy";
        copy.textContent = "Copy";
        copy.addEventListener("click", event => {
            clipboard.writeText(url.textContent)

            
        });
        document.querySelector(".modal-body").appendChild(url);
        document.querySelector(".modal-body").appendChild(copy);
    };

    $.ajax({
      type: "POST",
      url: "/polls",
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .done(success)
    .fail("not working");
    event.preventDefault();
};

form.addEventListener("submit", createPoll);

const select = document.querySelector('#optionSelect');
const createOptions = (event) => {
    const amount = parseInt(event.target.value);
        for(let i = event.target.value - 1; i >= 0; i--){
            let option = document.createElement("div");
            option.className = "form-group form-group w-50 p-3";
            let input = document.createElement("input");
            input.className = "form-control";
            input.type = "text";
            input.name = "poll_option[]";
            input.placeholder = "Enter poll option";
            input.required = true;
            option.appendChild(input);
            options.appendChild(option);                
        }
};
select.addEventListener("change", createOptions);