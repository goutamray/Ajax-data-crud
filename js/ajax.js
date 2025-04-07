$(document).ready(function () {
  // data tables init
  const devsTable = $("#devsTable").DataTable({
    ajax: {
      url: "./ajax/ajax_template.php?action=all_devs",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "photo",
        render: (data, type, row) => {
          return `<img src="./media/devs/${data}" />`;
        },
      },
      {
        data: "name",
      },
      {
        data: "age",
      },
      {
        data: "skill",
      },
      {
        data: "location",
      },
      {
        data: "status",
        render: (data, type, row) => {
          return ` <label class="switch status_switched" status="${data}" switchId="${
            row.id
          }">
          <input type="checkbox" ${data && "checked"}>
          <span class="slider round"></span>
        </label>`;
        },
      },
      {
        data: null,
        render: (data, type, row) => {
          return `  
          <button class="btn btn-info ">
          <i class="fa-solid fa-eye"></i>
        </button>
        <button class="btn btn-warning devs_edit_btn"  editId="${row.id}" data-bs-toggle="modal" data-bs-target="#edit_devs_modal">
          <i class="fa-solid fa-pen-to-square"></i>
        </button>
        <button class="btn btn-danger devs_data_delete">
          <i class="fa-solid fa-trash"></i>
        </button>
          
          `;
        },
      },
    ],
  });

  // create devs file
  $("#devs_create_form").submit(function (e) {
    e.preventDefault();

    // get form data
    $formData = new FormData(e.target);

    const { name, age, skill, location } = Object.fromEntries($formData);

    // validation
    if (!name || !age || !skill || !location) {
      Swal.fire("All Fields Are Required!");
    } else {
      $.ajax({
        url: "./ajax/ajax_template.php?action=create_devs",
        method: "Post",
        data: new FormData(e.target),
        contentType: false,
        processData: false,
        success: (data) => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `${data} Created Successfull`,
            showConfirmButton: false,
            timer: 1500,
          });

          e.target.reset();

          getAllDevsData();

          const modalclose = setInterval(() => {
            $(".btn-close").click();
            clearInterval(modalclose);
          }, 2000);
        },
      });
    }
  });

  // get all devs data
  const getAllDevsData = () => {
    $.ajax({
      url: "./ajax/ajax_template.php?action=all_devs",
      success: (data) => {
        const devs = JSON.parse(data);

        let devLists = [];
        devs.map((item, index) => {
          devLists += ` 
    <tr class="align-middle">
      <td>${index + 1}</td>  
      <td>
        <img src="/media/devs/${item.photo}" alt="">
      </td>
      <td>${item.name}</td>  
      <td> ${item.age} </td>  
      <td>${item.location}</td>  
      <td>${item.skill}</td>  
      <td>
        <label class="switch status_switched" status="${
          item.status
        }" switchId="${item.id}">
          <input type="checkbox" ${item.status && "checked"}>
          <span class="slider round"></span>
        </label>
      </td>
      <td>
        <button class="btn btn-info ">
          <i class="fa-solid fa-eye"></i>
        </button>
        <button class="btn btn-warning devs_edit_btn"  editId="${
          item.id
        }" data-bs-toggle="modal" data-bs-target="#edit_devs_modal">
          <i class="fa-solid fa-pen-to-square"></i>
        </button>
        <button class="btn btn-danger devs_data_delete">
          <i class="fa-solid fa-trash"></i>
        </button>
      </td>
    </tr>
  `;
        });

        $("#devs_data").html(devLists);
      },
    });
  };

  // status update
  $(document).on("click", ".status_switched", function () {
    const statusId = $(this).attr("switchId");
    const status = $(this).attr("status");

    $.ajax({
      url: "./ajax/ajax_template.php?action=devs_status_update",
      method: "POST",
      data: { statusId, status },
      success: (data) => {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: `Status Updated Successfull`,
          showConfirmButton: false,
          timer: 1500,
        });

        getAllDevsData();
      },
      error: (err) => {
        console.log(err);
      },
    });
  });

  // edit devs data
  $(document).on("click", ".devs_edit_btn", function () {
    const editIdData = $(this).attr("editId");

    $.ajax({
      url: "./ajax/ajax_template.php?action=devs_edit",
      method: "POST",
      data: { editIdData },
      success: (data) => {
        console.log("Response Data:", data); // Check the response
        const devs = JSON.parse(data); // Parse JSON

        // Ensure the array is not empty
        $(`#devs_update_form input[name="name"]`).val(devs.name);
        $(`#devs_update_form input[name="age"]`).val(devs.age);
        $(`#devs_update_form input[name="skill"]`).val(devs.skill);
        $(`#devs_update_form input[name="location"]`).val(devs.location);
        $(`#devs_update_form input[name="updateId"]`).val(devs.id);
        $(`#devs_update_form input[name="old_photo"]`).val(devs.photo);
        // Set image src with cache-busting

        $(`#devs_update_form #edit_devs_photo`).attr(
          "src",
          "/media/devs/" + devs.photo
        );
      },
      error: (err) => {
        console.log(err);
      },
    });
  });

  // devs update data
  $("#devs_update_form").submit(function (e) {
    e.preventDefault();

    //  const formData = new FormData(e.target);

    $.ajax({
      url: "./ajax/ajax_template.php?action=update_devs",
      method: "Post",
      data: new FormData(e.target),
      contentType: false,
      processData: false,
      success: (data) => {
        console.log(data);

        Swal.fire({
          position: "top-end",
          icon: "success",
          title: `Developer Updated Successfull`,
          showConfirmButton: false,
          timer: 1500,
        });
        e.target.reset();

        // reload data table
        devsTable.ajax.reload();

        getAllDevsData();
        const modalclose = setInterval(() => {
          $(".btn-close").click();
          clearInterval(modalclose);
        }, 2000);
      },
    });
  });

  getAllDevsData();
});
