# PowerShell script to fix the Current Tasks slider conflict

$file = "e:\Ai-chatsystem\resources\views\Chats\ticket.blade.php"
$content = Get-Content $file -Raw

# Fix 1: Change the slider container class and add unique classes
$content = $content -replace 'id="ticketsSliderSimple" class="mb-2 tickets-slider-simple"', 'id="currentTasksSlider" class="mb-2 current-tasks-slider"'

# Fix 2: Update button classes to be unique
$content = $content -replace '(<div id="currentTasksSlider"[^>]*>.*?)<button class="slider-arrow slider-prev"', '$1<button class="current-slider-arrow current-slider-prev"'
$content = $content -replace '(<div id="currentTasksSlider"[^>]*>.*?)<button class="current-slider-arrow current-slider-prev"[^>]*>.*?</button>\s*<button class="slider-arrow slider-next"', '$1<button class="current-slider-arrow current-slider-prev" type="button" aria-label="Previous"><i class="bi bi-chevron-left"></i></button><button class="current-slider-arrow current-slider-next"'

# Save the file
$content | Set-Content $file -NoNewline

Write-Host "Step 1: Updated slider container and button classes" -ForegroundColor Green
Write-Host "Please run the next steps manually or continue with the script" -ForegroundColor Yellow
