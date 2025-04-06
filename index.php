<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title> Ajax </title>
    <!-- bootstrap css -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- font awesome cdn -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <!-- custom css -->
    <link rel="stylesheet"
        href="./assets/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-8">
                <button class="btn btn-md btn-primary mb-2"
                    data-bs-toggle="modal"
                    data-bs-target="#create_devs_modal"> Create New Dev </button>
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center"> All Developer List </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td> #ID </td>
                                    <td> Photo </td>
                                    <td> Name </td>
                                    <td> Age </td>
                                    <td> Location </td>
                                    <td> Skill </td>
                                    <td> Status </td>
                                    <td> Action </td>
                                </tr>
                            </thead>
                            <tbody id="devs_data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--  devs create modal -->
    <div class="modal fade"
        id="create_devs_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="devs_head d-flex justify-content-between">
                        <h4> Create New Dev </h4>
                        <button class="btn-close"
                            data-bs-dismiss="modal"> </button>
                    </div>
                    <div class="form">
                        <form id="devs_create_form"
                            method="POST"
                            enctype="multipart/form-data">
                            <div class="my-2">
                                <label for=""> Name </label>
                                <input type="text"
                                    name="name"
                                    class="form-control">
                            </div>
                            <div class="my-2">
                                <label for=""> Age </label>
                                <input type="text"
                                    name="age"
                                    class="form-control">
                            </div>
                            <div class="my-2">
                                <label for=""> Skill </label>
                                <input type="text"
                                    name="skill"
                                    class="form-control">
                            </div>
                            <div class="my-2">
                                <label for=""> Location </label>
                                <input type="text"
                                    name="location"
                                    class="form-control">
                            </div>
                            <div class="my-2">
                                <label for=""> Photo </label>
                                <input type="file"
                                    name="photo"
                                    class="form-control">
                            </div>
                            <div class="my-2">
                                <button type="submit"
                                    class="btn btn-primary btn-md"> Create </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- single devs  modal -->
    <div class="modal fade"
        id="edit_devs_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="devs_head d-flex justify-content-between">
                        <h4> Update Developer </h4>
                        <button class="btn-close"
                            data-bs-dismiss="modal"> </button>
                    </div>
                    <div class="form">
                        <form id="devs_update_form"
                            method="POST"
                            enctype="multipart/form-data">
                            <div class="my-2">
                                <label for=""> Name </label>
                                <input type="text"
                                    name="name"
                                    class="form-control">
                            </div>
                            <div class="my-2">

                                <input type="hidden"
                                    name="updateId"
                                    class="form-control">
                                <input type="hidden"
                                    name="old_photo"
                                    class="form-control">
                            </div>
                            <div class="my-2">
                                <label for=""> Age </label>
                                <input type="text"
                                    name="age"
                                    class="form-control">
                            </div>
                            <div class="my-2">
                                <label for=""> Skill </label>
                                <input type="text"
                                    name="skill"
                                    class="form-control">
                            </div>
                            <div class="my-2">
                                <label for=""> Location </label>
                                <input type="text"
                                    name="location"
                                    class="form-control">
                            </div>
                            <div class="my-2">
                                <label for=""> Photo </label>
                                <div class="photo">
                                    <img src=""
                                        alt=""
                                        id="edit_devs_photo">
                                </div>
                                <input type="file"
                                    name="new_photo"
                                    class="form-control">
                            </div>
                            <div class="my-2">
                                <button type="submit"
                                    class="btn btn-primary btn-md"> Update </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- jquery  -->
        <script src="https://code.jquery.com/jquery-3.7.1.js"> </script>
        <!-- sweet alert  -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- bootstrap js  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- custom js  -->
        <script src="./js/ajax.js"></script>



</body>

</html>
