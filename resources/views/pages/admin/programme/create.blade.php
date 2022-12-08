<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="programme.index"></x-navbars.sidebar>
    <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Manage Programme / Create Programme"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body min-height-300 border-radius-xl mt-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">Create New Programme</h4>
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
                        <form method='POST' action='{{ route('programme.store') }}'>
                            @csrf
                            <div class="row justify-content-center">
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select border border-2 p-2 programmeType" name="type"
                                        required>
                                        <option disabled selected value>-- Select an option --</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" class="hiddenType" name="hiddenType" value="">

                                <div class="mb-3">
                                    <label class="form-label">Code</label>
                                    <input type="text" class="form-control border border-2 p-2" name="code"
                                        required maxlength="8">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control border border-2 p-2" name="title"
                                        required maxlength="128">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Structure</label>
                                    <div class="container ps-1">
                                        @for ($year = 1; $year < 5; $year++)
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
                                    <a class="btn bg-gradient-dark mb-2" href="{{ route('programme.index') }}"
                                        class="text-primary text-gradient font-weight-bold">Go Back</a>
                                    <button type="submit" class="btn bg-gradient-primary mb-2 mx-3">Create
                                        Programme</button>
                                    <a class="btn bg-gradient-info mb-2" href="{{ route('programme.create') }}">Reset</a>
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
    // Check for selected programme type -> set years
    $(".programmeType").on("change", function() {
        switch ($(this).find(':selected').text()) {
            case "Foundation Programme":
                $("#y1").show();
                $("#y2").hide();
                $("#y3").hide();
                $("#y4").hide();
                $(".programmeType").attr("disabled", "disabled");
                $(".hiddenType").val("Foundation Programme");
                break;
            case "Diploma":
                $("#y1").show();
                $("#y2").show();
                $("#y3").hide();
                $("#y4").hide();
                $(".programmeType").attr("disabled", "disabled");
                $(".hiddenType").val("Diploma");
                break;
            case "Bachelor Degree":
                $("#y1").show();
                $("#y2").show();
                $("#y3").show();
                $("#y4").hide();
                $(".programmeType").attr("disabled", "disabled");
                $(".hiddenType").val("Bachelor Degree");
                break;
            case "Master":
                $("#y1").show();
                $("#y2").show();
                $("#y3").hide();
                $("#y4").hide();
                $(".programmeType").attr("disabled", "disabled");
                $(".hiddenType").val("Master");
                break;
            case "Doctor of Philosophy":
                $("#y1").show();
                $("#y2").show();
                $("#y3").show();
                $("#y4").show();
                $(".programmeType").attr("disabled", "disabled");
                $(".hiddenType").val("Doctor of Philosophy");
                break;
            default:
                $("#y1").hide();
                $("#y2").hide();
                $("#y3").hide();
                $("#y4").hide();
                break;
        }
    }).change();

    // Dynamic Add Course Select Field (up to 6 times)
    let courseList = JSON.parse(`{!! $courses->toJson(JSON_PRETTY_PRINT) !!}`);

    $(document).ready(function() {
        courseList = courseList.map((c) => ({
            ...c,
            isSelected: false
        }));

        $(".semester-table").each(function(index, el) {
            let year = $(el).data("year");
            let sem = $(el).data("sem");

            $(this).children("tbody").children("tr:first-child").children("td:first-child").html(
                getCourseSelectionList(year, sem))

            loadCourseTable(year, sem, el);
        });

        $(".course-list-select").on('change', function() {

            let previousValue = $(this).attr("data-selectedValue");
            console.log([previousValue, this.value]);

            if (previousValue)
                toggleCourseItemVisibilityByCourseId(previousValue);

            toggleCourseItemVisibilityByCourseId(this.value);

            console.log(this);
            $(this).attr("data-selectedValue", this.value);

            bindReloadCourseLists();
        });

    });

    function loadCourseTable(year, sem, tableEl) {

        $(tableEl).find(".add-course-btn").click(function() {
            if ($(tableEl).children("tbody").children().length > 5)
                return;
            $(tableEl).append(getCourseListItem(year, sem));

            $(tableEl).find("tbody .remove-course-btn").on('click', function() {

                let selectedValue = $(this).parent().parent().children("td:first-child").children(
                    "select").attr("data-selectedValue");

                $(this).closest('tr').remove();

                if (selectedValue)
                    toggleCourseItemVisibilityByCourseId(selectedValue);

                bindReloadCourseLists();
            });

            $(".course-list-select").on('change', function() {

                let previousValue = $(this).attr("data-selectedValue");
                console.log([previousValue, this.value]);

                if (previousValue)
                    toggleCourseItemVisibilityByCourseId(previousValue);

                toggleCourseItemVisibilityByCourseId(this.value);

                console.log(this);
                $(this).attr("data-selectedValue", this.value);

                bindReloadCourseLists();
            });
        });
    }

    function bindReloadCourseLists() {
        $(".course-list-select").each(function() {

            let selectedCourseId = this.value;
            let sem = $(this).data("sem");
            let year = $(this).data("year");

            $(this).html(getReloadedCourseListOptions(selectedCourseId));
        });
    }

    function getCourseListItem(year, sem) {
        return (
            `<tr class="courseItem-y${year}s${sem}">` +
            `<td>` +
            `<select class="course-list-select form-select border border-2 p-2 mb-2" name="y${year}s${sem}c[]" data-year="${year}" data-sem="${sem}">` +
            `<option selected></option> ` +
            `${
                            courseList
                            .filter((course) => !course.isSelected)
                            .map((course) => {
                                const option = `<option class="course-option" value="${course.id}" >`+
                                                    `${course.code}&nbsp;${course.title}` +
                                                `</option>`;
                                return option;
                            })
                        }` +
            `</select>` +
            `</td>` +
            `<td class="text-end">` +
            `<button type="button" class="btn btn-danger remove-course-btn">Remove</button>` +
            `</td>` +
            `</tr>`
        );
    }

    function getCourseSelectionList(year, sem) {
        return (
            `<select class="course-list-select form-select border border-2 p-2 mb-2" name="y${year}s${sem}c[]" data-year="${year}" data-sem="${sem}">` +
            `<option selected></option> ` +
            `${
                    courseList
                    .filter((course) => !course.isSelected)
                    .map((course) => {
                        const option = `<option class="course-option" value="${course.id}" >`+
                                            `${course.code}&nbsp;${course.title}` +
                                        `</option>`;
                        return option;
                    })
                }` +
            `</select>`);
    }

    function getReloadedCourseListOptions(selectedCourseId) {
        return `<option class=""></option> ` +
            courseList
            .filter((course) => !course.isSelected || selectedCourseId == course.id)
            .map((course) => {
                if (course.id == selectedCourseId)
                    console.log(course.id);
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

</html>
