<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="programme.index"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage Programme / Edit Programme / {{ $programme->code }}">
        </x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body min-height-300 border-radius-xl mt-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">Edit Programme</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 justify-content-center">
                        @if ($errors->any())
                            <div class="row">
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method='POST' action='{{ route('programme.update', ['programme' => $programme]) }}'>
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-center">
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <input type="text" class="form-control border border-2 p-2" name="type"
                                        value="{{ $programme->type }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Code</label>
                                    <input type="text" class="form-control border border-2 p-2" name="code"
                                        maxlength="8" required maxlength="8" value="{{ $programme->code }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control border border-2 p-2" name="title"
                                        maxlength="128" required maxlength="128" value="{{ $programme->title }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Structure</label>
                                    <div class="container ps-1">
                                        @for ($year = 1; $year < $programmeYear + 1; $year++)
                                            <div class="row" id="y{{ $year }}">
                                                @for ($sem = 1; $sem < 4; $sem++)
                                                    <div class="col-12 col-md-4">
                                                        <b>Year {{ $year }} Sem {{ $sem }}</b>
                                                        <table class="table semester-table"
                                                            data-year="{{ $year }}"
                                                            data-sem="{{ $sem }}"
                                                            id="y{{ $year }}s{{ $sem }}">
                                                            <tbody>
                                                                <tr>
                                                                    <td></td>
                                                                    <td class="text-end">
                                                                        <button type="button"
                                                                            id="btn-add-y{{ $year }}s{{ $sem }}"
                                                                            class="btn btn-success add-course-btn">Add
                                                                            Course</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endfor
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                <div class="d-flex flex-row-reverse">
                                    <a class="btn bg-gradient-dark my-4 mb-2" href="{{ route('programme.index') }}"
                                        class="text-primary text-gradient font-weight-bold">Go Back</a>
                                    <button type="submit" class="btn bg-gradient-primary my-4 mb-2 mx-3">Update
                                        Programme</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </div>
</x-layout>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    // Dynamic Add Course Select Field (up to 6 times)
    let courseList = JSON.parse(`{!! $courses->toJson(JSON_PRETTY_PRINT) !!}`);
    let pStruc = JSON.parse(`{!! json_encode($programme_structure) !!}`);

    $(document).ready(function() {

        courseList = courseList.map((course) => {
            let isSelected = _.flattenDeep(pStruc).findIndex((existingCourse) => existingCourse.id ==
                course.id) !== -1;

            return ({
                ...course,
                isSelected: isSelected
            });
        });

        $(".semester-table").each(function(index, el) {
            let year = $(el).data("year");
            let sem = $(el).data("sem");

            let semesterIndex = ((year - 1) * 3) + sem - 1;
            let semester = pStruc[semesterIndex];

            let firstCourseId = semester[0] !== undefined ? semester[0].id : -1;

            $(this).children("tbody").children("tr:first-child").children("td:first-child").html(
                getCourseSelectionList(year, sem, firstCourseId))

            bindFirstRowAddBtnClickListener(year, sem, el);

            semester.forEach((course, index) => {
                if (index === 0 || !course)
                    return;
                addSubRowCourse(year, sem, el, course.id);
            });
        });

        bindReloadCourseLists();

        $(".course-list-select").on('change', function() {

            let previousValue = $(this).attr("data-selected-value");

            if (previousValue)
                toggleCourseItemVisibilityByCourseId(previousValue);

            toggleCourseItemVisibilityByCourseId(this.value);

            $(this).attr("data-selected-value", this.value);

            bindReloadCourseLists();
        });

    });

    function addSubRowCourse(year, sem, tableEl, selectedId) {

        if ($(tableEl).children("tbody").children().length > 5)
            return;

        if (selectedId === undefined)
            selectedId = -1;

        $(tableEl).append(getCourseListItem(year, sem, selectedId));

        $(tableEl).find("tbody .remove-course-btn").on('click', function() {

            let selectedValue = $(this).parent().parent().children("td:first-child").children(
                "select").attr("data-selected-value");

            $(this).closest('tr').remove();

            if (selectedValue)
                toggleCourseItemVisibilityByCourseId(selectedValue);

            bindReloadCourseLists();
        });

        $(".course-list-select").on('change', function() {

            let previousValue = $(this).attr("data-selected-value");

            if (previousValue)
                toggleCourseItemVisibilityByCourseId(previousValue);

            toggleCourseItemVisibilityByCourseId(this.value);

            $(this).attr("data-selected-value", this.value);

            bindReloadCourseLists();
        });
    }

    function bindFirstRowAddBtnClickListener(year, sem, tableEl) {

        $(tableEl).find(".add-course-btn").on('click', () => addSubRowCourse(year, sem, tableEl));

    }

    function bindReloadCourseLists() {
        $(".course-list-select").each(function() {

            let selectedCourseId = this.value;
            let sem = $(this).data("sem");
            let year = $(this).data("year");

            $(this).html(getReloadedCourseListOptions(selectedCourseId));
        });
    }

    function getCourseListItem(year, sem, selectedCourseId) {
        return (
            `<tr class="courseItem-y${year}s${sem}">` +
            `<td>` +
            `<select class="course-list-select form-select border border-2 p-2 mb-2" name="y${year}s${sem}c[]" data-year="${year}" data-sem="${sem}" data-selected-value=${selectedCourseId}>` +
            `${
                getReloadedCourseListOptions(selectedCourseId)
            }` +
            `</select>` +
            `</td>` +
            `<td class="text-end">` +
            `<button type="button" class="btn btn-danger remove-course-btn">Remove</button>` +
            `</td>` +
            `</tr>`
        );
    }

    function getCourseSelectionList(year, sem, selectedCourseId) {
        return (
            `<select class="course-list-select form-select border border-2 p-2 mb-2" name="y${year}s${sem}c[]" data-year="${year}" data-sem="${sem}" data-selected-value=${selectedCourseId}> ` +
            `${
                getReloadedCourseListOptions(selectedCourseId)
            }` +
            `</select>`);
    }

    function getReloadedCourseListOptions(selectedCourseId) {
        return `<option></option> ` +
            courseList
            .filter((course) => !course.isSelected || selectedCourseId == course.id)
            .map((course) => {
                const option = `<option class="course-option" value="${course.id}"
                                        ${course.isSelected && "selected"}>` +
                    `${course.code}&nbsp;${course.title}` +
                    `</option>`;
                return option;
            });
    }

    function toggleCourseItemVisibilityByCourseId(courseId) {
        courseList = courseList.map((course) => {
            if (courseId != course.id)
                return course;

            course.isSelected = !course.isSelected;
            return course;
        });
    }
</script>
