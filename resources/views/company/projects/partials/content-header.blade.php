<x-project-details-card
    title="Total Projects"
    :number="$all"
    icon="fa-solid fa-diagram-project"
    color="#4f46e5"
/>

<x-project-details-card
    title="Active"
    :number='$active'
    icon="fa-solid fa-check"
    color="#10b981"
/>

<x-project-details-card
    title="Completed"
    :number='$completed'
    icon="fa-solid fa-check-double"
    color="#f59e0b"
/>

<x-project-details-card
    title="Total Tasks"
    :number="6"
    icon="fa-solid fa-clipboard-list"
    color="#ef4444"
/>
