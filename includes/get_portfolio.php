<?php
require_once './config.php';

$pdo = getDBConnection();
if ($pdo) {
  try {
    $id = $_POST['id'] ?? null;
    $stmt = $pdo->prepare("SELECT * FROM portfolio_projects WHERE id = ?");
    $stmt->execute([$id]);
    $portfolio = $stmt->fetch(PDO::FETCH_ASSOC);
    $portfolio['technologies'] = array_map('trim', explode(',', $portfolio['technologies']));
    successResponse($portfolio);
  } catch (Exception $ex) {
    errorResponse($ex->getMessage());
  }
}
