@extends('customer.layouts.app') {{-- Use your main layout --}}

@section('content')
    <div class="container">
        <h1>Your Addresses</h1>

        <button id="add-address" class="btn btn-primary">Add New Address</button>

        <div id="address-list" class="mt-3">
            {{-- Address list will be populated here --}}
        </div>

        <!-- Address Form Modal -->
        <div id="address-modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Address Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="address-form">
                            @csrf
                            <input type="hidden" name="id" id="address-id">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" required>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city" required>
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" class="form-control" name="state" id="state">
                            </div>
                            <div class="form-group">
                                <label for="zip">Zip Code</label>
                                <input type="text" class="form-control" name="zip" id="zip" required>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" name="country" id="country" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Address Type</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="billing">Billing</option>
                                    <option value="shipping">Shipping</option>
                                </select>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="is_default" id="is_default">
                                <label class="form-check-label" for="is_default">Set as Default</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Address</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetchAddresses();

            document.getElementById('add-address').onclick = function () {
                clearForm();
                $('#address-modal').modal('show');
            };

            document.getElementById('address-form').onsubmit = function (e) {
                e.preventDefault();
                saveAddress();
            };
        });

        function fetchAddresses() {
            fetch('/api/addresses', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token') // Adjust based on your auth method
                }
            })
                .then(response => response.json())
                .then(addresses => {
                    const addressList = document.getElementById('address-list');
                    addressList.innerHTML = '';

                    addresses.forEach(address => {
                        const addressItem = document.createElement('div');
                        addressItem.classList.add('address-item');
                        addressItem.innerHTML = `
                                                    <p>${address.first_name} ${address.last_name}</p>
                                                    <p>${address.address}, ${address.city}, ${address.state} ${address.zip}, ${address.country}</p>
                                                    <p>Type: ${address.type}</p>
                                                    <button class="btn btn-sm btn-warning" onclick="editAddress(${address.id})">Edit</button>
                                                    <button class="btn btn-sm btn-danger" onclick="deleteAddress(${address.id})">Delete</button>
                                                    <hr>
                                                `;
                        addressList.appendChild(addressItem);
                    });
                })
                .catch(error => console.error('Error fetching addresses:', error));
        }

        function clearForm() {
            document.getElementById('address-form').reset();
            document.getElementById('address-id').value = '';
            document.getElementById('is_default').checked = false;
        }

        function saveAddress() {
            const formData = new FormData(document.getElementById('address-form'));

            const method = document.getElementById('address-id').value ? 'PUT' : 'POST';
            const url = method === 'PUT' ? `/api/addresses/${document.getElementById('address-id').value}` : '/api/addresses';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token') // Adjust based on your auth method
                }
            })
                .then(response => {
                    if (response.ok) {
                        fetchAddresses(); // Refresh the address list
                        $('#address-modal').modal('hide');
                    } else {
                        console.error('Error saving address:', response);
                    }
                });
        }

        function editAddress(id) {
            fetch(`/api/addresses/${id}`, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token') // Adjust based on your auth method
                }
            })
                .then(response => response.json())
                .then(address => {
                    document.getElementById('address-id').value = address.id;
                    document.getElementById('first_name').value = address.first_name;
                    document.getElementById('last_name').value = address.last_name;
                    document.getElementById('address').value = address.address;
                    document.getElementById('city').value = address.city;
                    document.getElementById('state').value = address.state || '';
                    document.getElementById('zip').value = address.zip;
                    document.getElementById('country').value = address.country;
                    document.getElementById('type').value = address.type;
                    document.getElementById('is_default').checked = address.is_default;

                    $('#address-modal').modal('show');
                });
        }

        function deleteAddress(id) {
            if (confirm('Are you sure you want to delete this address?')) {
                fetch(`/api/addresses/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token') // Adjust based on your auth method
                    }
                })
                    .then(response => {
                        if (response.ok) {
                            fetchAddresses(); // Refresh the address list
                        } else {
                            console.error('Error deleting address:', response);
                        }
                    });
            }
        }
    </script>
@endsection