    <form action="{{ route('add_result', [$profile->profile_id, $level_id]) }}" method="post" id="first_seme">
        @csrf
        <tr>
            <td><input class="form-control shadow-none" type="text" name="course[]" id="course1" required
                    autocomplete="off"></td>
            <td> <input class="form-control shadow-none" type="number" min="0" name="unit[]" id="unit1" required
                    autocomplete="off"></td>
            <td class="d-none"><input class="form-control shadow-none" type="text" name="semester" id="semester1"
                    value="first" required></td>
            <td> <select class="form-control shadow-none" name="grade[]" id="grade1" required>
                    <option></option>
                    @if ($profile->gp_type == '5')
                        <option value="5">A</option>
                        <option value="4">B</option>
                        <option value="3">C</option>
                        <option value="2">D</option>
                        <option value="1">E</option>
                        <option value="0">F</option>
                    @else
                        <option value="4">A</option>
                        <option value="3">B</option>
                        <option value="2">C</option>
                        <option value="1">D</option>
                        <option value="0">F</option>
                    @endif
                </select></td>
            <td><button type="submit" class="submit btn btn-link shadow-none"><svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-arrow-right-square" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4.5 5.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                    </svg>
                </button>
            </td>
        </tr>
    </form>
