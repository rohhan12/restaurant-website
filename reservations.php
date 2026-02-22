<?php
require_once 'config.php';

$success = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $guests = $_POST['guests'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';

    if (empty($name)) {
        $errors[] = 'Please enter the name!!';
    }
    if (empty($phone)) {
        $errors[] = 'Please enter the phone number!!';
    }
    if (empty($guests) || $guests < 1) {
        $errors[] = 'Number of guests is required';
    }
    if (empty($date)) {
        $errors[] = 'Date is required';
    } 
    if (empty($time)) {
        $errors[] = 'Time is required';
    }
    
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO reservations (customer_name, phone, guests, date, time) 
                                      VALUES (:name, :phone, :guests, :date, :time)");
        
        if ($stmt->execute([':name' => $name, ':phone' => $phone, ':guests' => $guests, ':date' => $date, ':time' => $time])) {
            $success = 'Reservation confirmed! We will contact you soon.';
            $_POST = [];
        } else {
            $errors[] = 'Something went wrong.Please try again!!';
        }
    }
}

include 'header.php';
?>
<main>
    <div class="header" style = "background-image:url(images/reserve.jpg);">
        <h1>Reserve a Table</h1>
        <p>Book your table for an unforgettable dining experience</p>
    </div>

    <section class="reservation-section">
        <div class="reservation-box">
            <h2>Reservation Details</h2>
            <?php if ($success): ?>
                <div class="success-message"><?php echo htmlspecialchars($success); ?>
            </div>
            <?php endif; ?>
                
            <?php if (!empty($errors)): ?>
                <div class="error-message">
                    <?php foreach ($errors as $e) echo "<div>• " . htmlspecialchars($e) . "</div>"; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="reservations.php">
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-input" 
                            value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="tel" name="phone" class="form-input" 
                            value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-input" min="<?php echo date('Y-m-d'); ?>" 
                            value="<?php echo htmlspecialchars($_POST['date'] ?? ''); ?>" required>
                </div>
                        
                <div class="form-group">
                    <label class="form-label">Time</label>
                    <select name="time" class="form-input" required>
                        <option value="">Select time</option>
                        <?php $times = ['9:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00'];
                        foreach ($times as $time) {
                            echo "<option value='$time'>$time</option>";
                        }
                        ?>
                    </select>
                </div>
                    
                <div class="form-group">
                    <label class="form-label">Number of Guests </label>
                    <input type="number" name="guests" class="form-input" min="1" max="20" 
                    value="<?php echo htmlspecialchars($_POST['guests'] ?? ''); ?>" required>
                </div>
                <button type="submit" class="submitButton">Reserve Table</button>
            </form>
        </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>