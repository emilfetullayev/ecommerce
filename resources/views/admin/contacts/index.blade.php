@extends('admin.layouts.app')

@section('content')

    @php
        $renderContacts = function ($contacts) {

            foreach ($contacts as $contact) {

                echo '<tr>';

                echo '<td>'.$contact->id.'</td>';

                echo '<td>'.$contact->name.'</td>';

                echo '<td>'.$contact->email.'</td>';

                echo '<td>'.\Illuminate\Support\Str::limit($contact->message, 50).'</td>';

                echo '<td>'.$contact->created_at.'</td>';

                echo '<td>';

                // yalnız baxış (edit yoxdur)
                echo '<span class="badge bg-success">New</span>';

                echo '</td>';

                echo '</tr>';
            }
        };
    @endphp

    <div class="container-fluid">

        <div class="row">

            {{-- LIST --}}
            <div class="col-lg-12">

                <div class="card">

                    <div class="card-header">
                        <h4>Contact Messages</h4>
                    </div>

                    <div class="card-body">

                        <table class="table align-middle">

                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php
                                $renderContacts($contacts);
                            @endphp
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
