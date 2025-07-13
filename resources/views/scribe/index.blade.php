<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.2.1.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.2.1.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-tasks" class="tocify-header">
                <li class="tocify-item level-1" data-unique="tasks">
                    <a href="#tasks">Tasks</a>
                </li>
                                    <ul id="tocify-subheader-tasks" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="tasks-POSTapi-tasks-create">
                                <a href="#tasks-POSTapi-tasks-create">Create New Task</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="tasks-POSTapi-tasks--id--update">
                                <a href="#tasks-POSTapi-tasks--id--update">Update Task Data</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="tasks-POSTapi-tasks--id--add-dependents">
                                <a href="#tasks-POSTapi-tasks--id--add-dependents">Add dependents</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="tasks-GETapi-tasks">
                                <a href="#tasks-GETapi-tasks">Get Tasks</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="tasks-GETapi-tasks--id-">
                                <a href="#tasks-GETapi-tasks--id-">Get Task</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="tasks-POSTapi-tasks--id--change-status">
                                <a href="#tasks-POSTapi-tasks--id--change-status">Change Task Status</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-user-auth" class="tocify-header">
                <li class="tocify-item level-1" data-unique="user-auth">
                    <a href="#user-auth">User Auth</a>
                </li>
                                    <ul id="tocify-subheader-user-auth" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="user-auth-POSTapi-register">
                                <a href="#user-auth-POSTapi-register">Register User</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-auth-POSTapi-login">
                                <a href="#user-auth-POSTapi-login">Login User</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-auth-POSTapi-logout">
                                <a href="#user-auth-POSTapi-logout">Logout User</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-auth-GETapi-user">
                                <a href="#user-auth-GETapi-user">Get Logged In User</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-auth-POSTapi-user-update">
                                <a href="#user-auth-POSTapi-user-update">Update User</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-auth-POSTapi-change-role">
                                <a href="#user-auth-POSTapi-change-role">Change User Role</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-auth-GETapi-users">
                                <a href="#user-auth-GETapi-users">Get Users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-auth-GETapi-users--id-">
                                <a href="#user-auth-GETapi-users--id-">Get User</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: July 13, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>This API is a task management backend system built with Laravel. It is designed to facilitate task creation, assignment, dependency tracking, and role-based collaboration within a team.</p>
<p>Key Features:</p>
<ul>
<li><strong>Authentication</strong> using Laravel Sanctum with secure registration and login endpoints.</li>
<li><strong>Role-based access control</strong> using Spatie Permissions (Admin, Manager, User).</li>
<li><strong>Task management</strong> including creation, updates, status changes, and filtering by due date, status, and assignee.</li>
<li><strong>Task dependencies</strong> support to ensure that tasks can't be marked as completed until their dependent tasks are finished.</li>
<li><strong>RESTful API design</strong> following best practices, with input validation, error handling, and policy-based authorization.</li>
<li><strong>API Documentation</strong> generated with Scribe, including response samples, authentication headers, and detailed request requirements.</li>
</ul>
<p>This documentation is auto-generated and kept up-to-date with the latest API behavior to serve developers and integrators effectively.</p>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="tasks">Tasks</h1>

    

                                <h2 id="tasks-POSTapi-tasks-create">Create New Task</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<ul>
<li>
<p>Creates a new task with assignees (users).</p>
</li>
<li>
<p>user cannot be entered twice.</p>
</li>
<li>
<p>Default status (Pending)</p>
</li>
<li>
<p>Example of properties:</p>
<ul>
<li>
<p>&quot;depends_on_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;dependents_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;assignees&quot;: [
{
&quot;id&quot;: 4,
&quot;name&quot;: &quot;Michael Murazik III&quot;,
&quot;email&quot;: &quot;harber.hazle@example.com&quot;,
&quot;role&quot;: &quot;user&quot;
}
],</p>
</li>
</ul>
</li>
<li>
<p>Access Level: Admin , Manager</p>
</li>
</ul>

<span id="example-requests-POSTapi-tasks-create">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/tasks/create" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"b\",
    \"description\": \"Et animi quos velit et fugiat.\",
    \"assignees_ids\": [
        16
    ],
    \"due_date\": \"2051-08-06\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/tasks/create"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "b",
    "description": "Et animi quos velit et fugiat.",
    "assignees_ids": [
        16
    ],
    "due_date": "2051-08-06"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-tasks-create">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 136,
    &quot;title&quot;: &quot;Et animi quos velit et fugiat.&quot;,
    &quot;description&quot;: &quot;Accusantium harum mollitia modi deserunt aut ab. Perspiciatis quo omnis nostrum aut adipisci quidem nostrum qui. Incidunt iure odit et et modi ipsum.&quot;,
    &quot;status&quot;: &quot;pending&quot;,
    &quot;owner_name&quot;: &quot;Mr. Carey Smitham&quot;,
    &quot;owner_id&quot;: 257,
    &quot;assignees&quot;: [],
    &quot;depends_on_links&quot;: [],
    &quot;dependents_links&quot;: [],
    &quot;due_date&quot;: &quot;2025-07-28T21:39:00.000000Z&quot;,
    &quot;created_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
    &quot;is_owner&quot;: false
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-tasks-create" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-tasks-create"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-tasks-create"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-tasks-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-tasks-create">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-tasks-create" data-method="POST"
      data-path="api/tasks/create"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-tasks-create', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-tasks-create"
                    onclick="tryItOut('POSTapi-tasks-create');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-tasks-create"
                    onclick="cancelTryOut('POSTapi-tasks-create');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-tasks-create"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/tasks/create</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-tasks-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-tasks-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-tasks-create"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 200 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-tasks-create"
               value="Et animi quos velit et fugiat."
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>Et animi quos velit et fugiat.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>assignees_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="assignees_ids[0]"                data-endpoint="POSTapi-tasks-create"
               data-component="body">
        <input type="number" style="display: none"
               name="assignees_ids[1]"                data-endpoint="POSTapi-tasks-create"
               data-component="body">
    <br>
<p>This field is required unless <code>assignees_ids</code> is in <code>null</code>. The <code>id</code> of an existing record in the users table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>due_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="due_date"                data-endpoint="POSTapi-tasks-create"
               value="2051-08-06"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a valid date in the format <code>Y-m-d H:i:s</code>. Must be a date after or equal to <code>today</code>. Example: <code>2051-08-06</code></p>
        </div>
        </form>

                    <h2 id="tasks-POSTapi-tasks--id--update">Update Task Data</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<ul>
<li>
<p>update the task data (except for status and dependents located in separate endpoints)</p>
</li>
<li>
<p>Example of properties:</p>
<ul>
<li>
<p>&quot;depends_on_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;dependents_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;assignees&quot;: [
{
&quot;id&quot;: 4,
&quot;name&quot;: &quot;Michael Murazik III&quot;,
&quot;email&quot;: &quot;harber.hazle@example.com&quot;,
&quot;role&quot;: &quot;user&quot;
}
],</p>
</li>
</ul>
</li>
<li>
<p>Access Level : Manager , Admin</p>
</li>
</ul>

<span id="example-requests-POSTapi-tasks--id--update">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/tasks/1/update" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"b\",
    \"description\": \"Et animi quos velit et fugiat.\",
    \"due_date\": \"2051-08-06\",
    \"assignees_ids\": [
        16
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/tasks/1/update"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "b",
    "description": "Et animi quos velit et fugiat.",
    "due_date": "2051-08-06",
    "assignees_ids": [
        16
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-tasks--id--update">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 137,
    &quot;title&quot;: &quot;Et animi quos velit et fugiat.&quot;,
    &quot;description&quot;: &quot;Accusantium harum mollitia modi deserunt aut ab. Perspiciatis quo omnis nostrum aut adipisci quidem nostrum qui. Incidunt iure odit et et modi ipsum.&quot;,
    &quot;status&quot;: &quot;pending&quot;,
    &quot;owner_name&quot;: &quot;Mr. Carey Smitham&quot;,
    &quot;owner_id&quot;: 258,
    &quot;assignees&quot;: [],
    &quot;depends_on_links&quot;: [],
    &quot;dependents_links&quot;: [],
    &quot;due_date&quot;: &quot;2025-07-28T21:39:00.000000Z&quot;,
    &quot;created_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
    &quot;is_owner&quot;: false
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-tasks--id--update" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-tasks--id--update"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-tasks--id--update"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-tasks--id--update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-tasks--id--update">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-tasks--id--update" data-method="POST"
      data-path="api/tasks/{id}/update"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-tasks--id--update', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-tasks--id--update"
                    onclick="tryItOut('POSTapi-tasks--id--update');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-tasks--id--update"
                    onclick="cancelTryOut('POSTapi-tasks--id--update');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-tasks--id--update"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/tasks/{id}/update</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-tasks--id--update"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-tasks--id--update"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-tasks--id--update"
               value="1"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-tasks--id--update"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 200 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-tasks--id--update"
               value="Et animi quos velit et fugiat."
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>Et animi quos velit et fugiat.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>due_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="due_date"                data-endpoint="POSTapi-tasks--id--update"
               value="2051-08-06"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a valid date in the format <code>Y-m-d H:i:s</code>. Must be a date after or equal to <code>today</code>. Example: <code>2051-08-06</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>assignees_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="assignees_ids[0]"                data-endpoint="POSTapi-tasks--id--update"
               data-component="body">
        <input type="number" style="display: none"
               name="assignees_ids[1]"                data-endpoint="POSTapi-tasks--id--update"
               data-component="body">
    <br>
<p>This field is required unless <code>assignees_ids</code> is in <code>null</code>. The <code>id</code> of an existing record in the users table.</p>
        </div>
        </form>

                    <h2 id="tasks-POSTapi-tasks--id--add-dependents">Add dependents</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<ul>
<li>
<p>assign task to the parent task to make them dependent on it</p>
</li>
<li>
<p>Example of properties:</p>
<ul>
<li>
<p>&quot;depends_on_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;dependents_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;assignees&quot;: [
{
&quot;id&quot;: 4,
&quot;name&quot;: &quot;Michael Murazik III&quot;,
&quot;email&quot;: &quot;harber.hazle@example.com&quot;,
&quot;role&quot;: &quot;user&quot;
}
],</p>
</li>
</ul>
</li>
<li>
<p>Access Level : Manager , Admin</p>
</li>
</ul>

<span id="example-requests-POSTapi-tasks--id--add-dependents">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/tasks/1/add-dependents" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"dependent_tasks_ids\": [
        16
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/tasks/1/add-dependents"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "dependent_tasks_ids": [
        16
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-tasks--id--add-dependents">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 138,
    &quot;title&quot;: &quot;Et animi quos velit et fugiat.&quot;,
    &quot;description&quot;: &quot;Accusantium harum mollitia modi deserunt aut ab. Perspiciatis quo omnis nostrum aut adipisci quidem nostrum qui. Incidunt iure odit et et modi ipsum.&quot;,
    &quot;status&quot;: &quot;pending&quot;,
    &quot;owner_name&quot;: &quot;Mr. Carey Smitham&quot;,
    &quot;owner_id&quot;: 259,
    &quot;assignees&quot;: [],
    &quot;depends_on_links&quot;: [],
    &quot;dependents_links&quot;: [],
    &quot;due_date&quot;: &quot;2025-07-28T21:39:00.000000Z&quot;,
    &quot;created_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
    &quot;is_owner&quot;: false
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-tasks--id--add-dependents" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-tasks--id--add-dependents"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-tasks--id--add-dependents"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-tasks--id--add-dependents" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-tasks--id--add-dependents">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-tasks--id--add-dependents" data-method="POST"
      data-path="api/tasks/{id}/add-dependents"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-tasks--id--add-dependents', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-tasks--id--add-dependents"
                    onclick="tryItOut('POSTapi-tasks--id--add-dependents');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-tasks--id--add-dependents"
                    onclick="cancelTryOut('POSTapi-tasks--id--add-dependents');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-tasks--id--add-dependents"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/tasks/{id}/add-dependents</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-tasks--id--add-dependents"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-tasks--id--add-dependents"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-tasks--id--add-dependents"
               value="1"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>dependent_tasks_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="dependent_tasks_ids[0]"                data-endpoint="POSTapi-tasks--id--add-dependents"
               data-component="body">
        <input type="number" style="display: none"
               name="dependent_tasks_ids[1]"                data-endpoint="POSTapi-tasks--id--add-dependents"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the tasks table.</p>
        </div>
        </form>

                    <h2 id="tasks-GETapi-tasks">Get Tasks</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve tasks with optional filters.</p>
<p>Filters:</p>
<ul>
<li>
<p><code>status</code>: pending, in_progress, completed, cancelled</p>
</li>
<li>
<p><code>title</code>: partial match</p>
</li>
<li>
<p><code>owner_id</code>: filter by owner</p>
</li>
<li>
<p><code>assignee_id</code>: filter by assigned user</p>
</li>
<li>
<p><code>due_date_from</code>, <code>due_date_to</code>: filter by due date range</p>
</li>
<li>
<p>Example of properties:</p>
<ul>
<li>
<p>&quot;depends_on_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;dependents_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;assignees&quot;: [
{
&quot;id&quot;: 4,
&quot;name&quot;: &quot;Michael Murazik III&quot;,
&quot;email&quot;: &quot;harber.hazle@example.com&quot;,
&quot;role&quot;: &quot;user&quot;
}
],</p>
</li>
</ul>
</li>
<li>
<p>Access Level: user (own tasks), manager, admin (all)</p>
</li>
</ul>

<span id="example-requests-GETapi-tasks">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/tasks" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"cancelled\",
    \"title\": \"b\",
    \"owner_id\": 16,
    \"assignee_id\": 16,
    \"due_date_from\": \"2021-08-05\",
    \"due_date_to\": \"2051-08-06\",
    \"per_page\": 22
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/tasks"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "cancelled",
    "title": "b",
    "owner_id": 16,
    "assignee_id": 16,
    "due_date_from": "2021-08-05",
    "due_date_to": "2051-08-06",
    "per_page": 22
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tasks">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 139,
        &quot;title&quot;: &quot;Animi quos velit et fugiat.&quot;,
        &quot;description&quot;: &quot;Accusantium harum mollitia modi deserunt aut ab. Perspiciatis quo omnis nostrum aut adipisci quidem nostrum qui. Incidunt iure odit et et modi ipsum.&quot;,
        &quot;status&quot;: &quot;pending&quot;,
        &quot;owner_name&quot;: &quot;Mr. Carey Smitham&quot;,
        &quot;owner_id&quot;: 260,
        &quot;assignees&quot;: [],
        &quot;depends_on_links&quot;: [],
        &quot;dependents_links&quot;: [],
        &quot;due_date&quot;: &quot;2025-07-28T21:39:00.000000Z&quot;,
        &quot;created_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
        &quot;is_owner&quot;: false
    },
    {
        &quot;id&quot;: 140,
        &quot;title&quot;: &quot;Doloremque id aut libero aliquam veniam corporis.&quot;,
        &quot;description&quot;: &quot;Deleniti nemo odit quia officia. Dignissimos neque blanditiis odio. Excepturi doloribus delectus fugit qui repudiandae laboriosam.&quot;,
        &quot;status&quot;: &quot;pending&quot;,
        &quot;owner_name&quot;: &quot;Jacques Howe&quot;,
        &quot;owner_id&quot;: 261,
        &quot;assignees&quot;: [],
        &quot;depends_on_links&quot;: [],
        &quot;dependents_links&quot;: [],
        &quot;due_date&quot;: &quot;2025-08-11T03:58:23.000000Z&quot;,
        &quot;created_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
        &quot;is_owner&quot;: false
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tasks" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tasks"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tasks"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tasks" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tasks">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tasks" data-method="GET"
      data-path="api/tasks"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tasks', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tasks"
                    onclick="tryItOut('GETapi-tasks');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tasks"
                    onclick="cancelTryOut('GETapi-tasks');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tasks"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tasks</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tasks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tasks"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-tasks"
               value="cancelled"
               data-component="body">
    <br>
<p>Example: <code>cancelled</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>pending</code></li> <li><code>in_progress</code></li> <li><code>completed</code></li> <li><code>cancelled</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="GETapi-tasks"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>owner_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="owner_id"                data-endpoint="GETapi-tasks"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>assignee_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="assignee_id"                data-endpoint="GETapi-tasks"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>due_date_from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="due_date_from"                data-endpoint="GETapi-tasks"
               value="2021-08-05"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date before or equal to <code>due_date_to</code>. Example: <code>2021-08-05</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>due_date_to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="due_date_to"                data-endpoint="GETapi-tasks"
               value="2051-08-06"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>due_date_from</code>. Example: <code>2051-08-06</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-tasks"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 100. Example: <code>22</code></p>
        </div>
        </form>

                    <h2 id="tasks-GETapi-tasks--id-">Get Task</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<ul>
<li>
<p>Get a single task details using the task id</p>
</li>
<li>
<p>Example of properties:</p>
<ul>
<li>
<p>&quot;depends_on_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;dependents_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;assignees&quot;: [
{
&quot;id&quot;: 4,
&quot;name&quot;: &quot;Michael Murazik III&quot;,
&quot;email&quot;: &quot;harber.hazle@example.com&quot;,
&quot;role&quot;: &quot;user&quot;
}
],</p>
</li>
</ul>
</li>
<li>
<p>Access Level: Admin , Manager , User(if assigned)</p>
</li>
</ul>

<span id="example-requests-GETapi-tasks--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/tasks/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/tasks/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tasks--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 141,
    &quot;title&quot;: &quot;Et animi quos velit et fugiat.&quot;,
    &quot;description&quot;: &quot;Accusantium harum mollitia modi deserunt aut ab. Perspiciatis quo omnis nostrum aut adipisci quidem nostrum qui. Incidunt iure odit et et modi ipsum.&quot;,
    &quot;status&quot;: &quot;pending&quot;,
    &quot;owner_name&quot;: &quot;Mr. Carey Smitham&quot;,
    &quot;owner_id&quot;: 262,
    &quot;assignees&quot;: [],
    &quot;depends_on_links&quot;: [],
    &quot;dependents_links&quot;: [],
    &quot;due_date&quot;: &quot;2025-07-28T21:39:00.000000Z&quot;,
    &quot;created_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
    &quot;is_owner&quot;: false
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tasks--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tasks--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tasks--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tasks--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tasks--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tasks--id-" data-method="GET"
      data-path="api/tasks/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tasks--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tasks--id-"
                    onclick="tryItOut('GETapi-tasks--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tasks--id-"
                    onclick="cancelTryOut('GETapi-tasks--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tasks--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tasks/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tasks--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tasks--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-tasks--id-"
               value="16"
               data-component="url">
    <br>
<p>The desired task id Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="tasks-POSTapi-tasks--id--change-status">Change Task Status</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<ul>
<li>
<p>update the task status to --&gt; (Pending , In Progress , Completed , Cancelled)</p>
</li>
<li>
<p>Example of properties:</p>
<ul>
<li>
<p>&quot;depends_on_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;dependents_links&quot;: [
&quot;id&quot;: 8,
&quot;title&quot;: &quot;Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.&quot;,
&quot;link&quot;: &quot;<a href="http://localhost:8000/api/tasks/8">http://localhost:8000/api/tasks/8</a>&quot;
],</p>
</li>
<li>
<p>&quot;assignees&quot;: [
{
&quot;id&quot;: 4,
&quot;name&quot;: &quot;Michael Murazik III&quot;,
&quot;email&quot;: &quot;harber.hazle@example.com&quot;,
&quot;role&quot;: &quot;user&quot;
}
],</p>
</li>
</ul>
</li>
<li>
<p>Access Level: N/A</p>
</li>
<li>
<p><strong>NOTE</strong> setting the task to cancelled is only limited to manager access level</p>
</li>
</ul>

<span id="example-requests-POSTapi-tasks--id--change-status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/tasks/1/change-status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"pending\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/tasks/1/change-status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "pending"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-tasks--id--change-status">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 142,
    &quot;title&quot;: &quot;Veniam corporis dolorem mollitia.&quot;,
    &quot;description&quot;: &quot;Odit quia officia est dignissimos neque blanditiis odio. Excepturi doloribus delectus fugit qui repudiandae laboriosam. Alias tenetur ratione nemo voluptate accusamus ut et.&quot;,
    &quot;status&quot;: &quot;pending&quot;,
    &quot;owner_name&quot;: &quot;Mr. Graham Crist&quot;,
    &quot;owner_id&quot;: 263,
    &quot;assignees&quot;: [],
    &quot;depends_on_links&quot;: [],
    &quot;dependents_links&quot;: [],
    &quot;due_date&quot;: &quot;2025-07-17T07:57:50.000000Z&quot;,
    &quot;created_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-07-13T02:56:50.000000Z&quot;,
    &quot;is_owner&quot;: false
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-tasks--id--change-status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-tasks--id--change-status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-tasks--id--change-status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-tasks--id--change-status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-tasks--id--change-status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-tasks--id--change-status" data-method="POST"
      data-path="api/tasks/{id}/change-status"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-tasks--id--change-status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-tasks--id--change-status"
                    onclick="tryItOut('POSTapi-tasks--id--change-status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-tasks--id--change-status"
                    onclick="cancelTryOut('POSTapi-tasks--id--change-status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-tasks--id--change-status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/tasks/{id}/change-status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-tasks--id--change-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-tasks--id--change-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-tasks--id--change-status"
               value="1"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-tasks--id--change-status"
               value="pending"
               data-component="body">
    <br>
<p>Example: <code>pending</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>pending</code></li> <li><code>in_progress</code></li> <li><code>completed</code></li> <li><code>cancelled</code></li></ul>
        </div>
        </form>

                <h1 id="user-auth">User Auth</h1>

    

                                <h2 id="user-auth-POSTapi-register">Register User</h2>

<p>
</p>

<p>Register new user</p>
<p>Access Level: N/A</p>

<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"architecto\",
    \"email\": \"zbailey@example.net\",
    \"password\": \"=iw\\/kXw)=az&lt;mA)=52)=L%M{8,}\",
    \"password_confirmation\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "architecto",
    "email": "zbailey@example.net",
    "password": "=iw\/kXw)=az&lt;mA)=52)=L%M{8,}",
    "password_confirmation": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 249,
    &quot;name&quot;: &quot;Ms. Elisabeth Okuneva&quot;,
    &quot;email&quot;: &quot;gulgowski.asia@example.com&quot;,
    &quot;role&quot;: &quot;user&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-register"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-register"
               value="=iw/kXw)=az<mA)=52)=L%M{8,}"
               data-component="body">
    <br>
<p>Must match the regex /^(?=.<em>[a-z])(?=.</em>[A-Z])(?=.<em>\d)(?=.</em>[@$!%<em>#?&amp;^_-])[A-Za-z\d@$!%</em>#?&amp;^_-]{8,}$/. Example: <code>=iw/kXw)=az&lt;mA)=52)=L%M{8,}</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-register"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="user-auth-POSTapi-login">Login User</h2>

<p>
</p>

<p>Login a user and return a token.</p>
<p>Access Level: N/A</p>

<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"password\": \"|]|{+-\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "password": "|]|{+-"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 250,
        &quot;name&quot;: &quot;Mrs. Justina Gaylord&quot;,
        &quot;email&quot;: &quot;lafayette.considine@example.com&quot;,
        &quot;role&quot;: &quot;user&quot;
    },
    &quot;token&quot;: &quot;5|kBPlXpDNHg491Yg5qTJr2jdTq9PL8L8Z8i0w4jYz22d20fdc&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-login"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. The <code>email</code> of an existing record in the users table. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-login"
               value="|]|{+-"
               data-component="body">
    <br>
<p>Example: <code>|]|{+-</code></p>
        </div>
        </form>

                    <h2 id="user-auth-POSTapi-logout">Logout User</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Log user out</p>
<p>Access Level: N/A</p>

<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Logged out successfully&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="user-auth-GETapi-user">Get Logged In User</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>get user's own data</p>
<p>Access Level: N/A</p>

<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 251,
    &quot;name&quot;: &quot;Mr. Adriel Romaguera&quot;,
    &quot;email&quot;: &quot;antonio24@example.net&quot;,
    &quot;role&quot;: &quot;user&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="user-auth-POSTapi-user-update">Update User</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update user's own data such as (name ,  email , password)
Password confirmation is required only when there is a new password entered</p>
<p>Access Level: N/A</p>

<span id="example-requests-POSTapi-user-update">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/user/update" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"architecto\",
    \"email\": \"zbailey@example.net\",
    \"password\": \"=iw\\/kXw)=az&lt;mA)=52)=L%M{8,}\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/update"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "architecto",
    "email": "zbailey@example.net",
    "password": "=iw\/kXw)=az&lt;mA)=52)=L%M{8,}"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-user-update">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 252,
    &quot;name&quot;: &quot;Mina Bauch&quot;,
    &quot;email&quot;: &quot;okeefe.isidro@example.org&quot;,
    &quot;role&quot;: &quot;user&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-user-update" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-user-update"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user-update"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-user-update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user-update">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-user-update" data-method="POST"
      data-path="api/user/update"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-user-update', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-user-update"
                    onclick="tryItOut('POSTapi-user-update');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-user-update"
                    onclick="cancelTryOut('POSTapi-user-update');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-user-update"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/user/update</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-user-update"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-user-update"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-user-update"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-user-update"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-user-update"
               value="=iw/kXw)=az<mA)=52)=L%M{8,}"
               data-component="body">
    <br>
<p>Must match the regex /^(?=.<em>[a-z])(?=.</em>[A-Z])(?=.<em>\d)(?=.</em>[@$!%<em>#?&amp;^_-])[A-Za-z\d@$!%</em>#?&amp;^_-]{8,}$/. Example: <code>=iw/kXw)=az&lt;mA)=52)=L%M{8,}</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-user-update"
               value=""
               data-component="body">
    <br>
<p>This field is required unless <code>password</code> is in <code>null</code>.</p>
        </div>
        </form>

                    <h2 id="user-auth-POSTapi-change-role">Change User Role</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Changes the user role from user to manager or vice versa.</p>
<p>Access Level: Admin</p>

<span id="example-requests-POSTapi-change-role">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/change-role" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"role_name\": \"user\",
    \"user_id\": 16
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/change-role"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "role_name": "user",
    "user_id": 16
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-change-role">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 253,
    &quot;name&quot;: &quot;Ms. Elisabeth Okuneva&quot;,
    &quot;email&quot;: &quot;idickens@example.org&quot;,
    &quot;role&quot;: &quot;user&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-change-role" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-change-role"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-change-role"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-change-role" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-change-role">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-change-role" data-method="POST"
      data-path="api/change-role"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-change-role', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-change-role"
                    onclick="tryItOut('POSTapi-change-role');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-change-role"
                    onclick="cancelTryOut('POSTapi-change-role');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-change-role"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/change-role</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-change-role"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-change-role"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role_name"                data-endpoint="POSTapi-change-role"
               value="user"
               data-component="body">
    <br>
<p>Example: <code>user</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>manager</code></li> <li><code>user</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-change-role"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>16</code></p>
        </div>
        </form>

                    <h2 id="user-auth-GETapi-users">Get Users</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>get list of users</p>
<p>Access Level : Manager</p>

<span id="example-requests-GETapi-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/users" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/users"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 254,
        &quot;name&quot;: &quot;Mya DuBuque&quot;,
        &quot;email&quot;: &quot;breitenberg.gilbert@example.com&quot;,
        &quot;role&quot;: &quot;user&quot;
    },
    {
        &quot;id&quot;: 255,
        &quot;name&quot;: &quot;Morgan Hirthe&quot;,
        &quot;email&quot;: &quot;dare.emelie@example.com&quot;,
        &quot;role&quot;: &quot;user&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users" data-method="GET"
      data-path="api/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users"
                    onclick="tryItOut('GETapi-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users"
                    onclick="cancelTryOut('GETapi-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="user-auth-GETapi-users--id-">Get User</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a selected user depending on the id</p>
<p>Access Level: Manager</p>

<span id="example-requests-GETapi-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/users/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/users/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 256,
    &quot;name&quot;: &quot;Prof. Mina Bauch&quot;,
    &quot;email&quot;: &quot;ztromp@example.org&quot;,
    &quot;role&quot;: &quot;user&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users--id-" data-method="GET"
      data-path="api/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users--id-"
                    onclick="tryItOut('GETapi-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users--id-"
                    onclick="cancelTryOut('GETapi-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-users--id-"
               value="1"
               data-component="url">
    <br>
<p>searched user's id Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
