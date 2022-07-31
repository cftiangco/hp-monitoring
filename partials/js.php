<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });

    document.addEventListener('alpine:init', () => {
        Alpine.data('addUser', () => ({
            errors: [],
            isModalOpen: false,
            firstName: '',
            lastName: '',
            userName: '',
            password: '',
            confirmPassword: '',
            role: '1',
            users: [],
            search: '',
            init() {
                fetch('api/users.php?action=getusers')
                    .then((response) => response.json())
                    .then((data) => {
                        this.users = data.data;
                        console.log(data.data)
                    });
            },
            onSave() {

                this.errors = [];

                if (this.firstName === "") {
                    this.errors.push("First Name is required");
                }

                if (this.lastName === "") {
                    this.errors.push("Last Name is required");
                }

                if (this.userName === "") {
                    this.errors.push("Username is required");
                }

                if (this.password === "") {
                    this.errors.push("Password is required");
                }

                if (this.password !== this.confirmPassword) {
                    this.errors.push("Password didn't matched the confirm password");
                }

                if (this.errors.length === 0) {

                    let payload = {
                        firstname: this.firstName,
                        lastname: this.lastName,
                        role_id: this.role,
                        username: this.userName,
                        password: this.password,
                    };

                    postData('api/users.php?action=create', payload)
                        .then((data) => {
                            if (data.status === 201) {
                                console.log(data);
                                this.isModalOpen = false;
                                return;
                            }
                        });

                }
            },
            searchUser() {
                if (this.search !== "") {
                    fetch(`api/users.php?action=search&query=${this.search}`)
                        .then((response) => response.json())
                        .then((data) => {
                            this.users = data.data;
                            console.log(data)
                        });
                } else {
                    this.init();
                }
            }
        }));
    });

    async function postData(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                'Content-Type': 'application/json'
                // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }
</script>