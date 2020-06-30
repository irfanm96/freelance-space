<div>
    <p>Project : {{$project->name}}</p>
    <p>Owner : {{optional($project->owner)->name}} </p>
    <p>Email : {{optional($project->owner)->email}} </p>
    <p>Phone : {{optional($project->owner)->phone}} </p>
    <p></p>
</div>